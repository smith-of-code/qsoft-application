<?php

namespace QSoft\Events;

use Bitrix\Main\GroupTable;
use Bitrix\Main\Mail\Event as EmailEvent;
use CSite;
use \CTicketDictionary;
use \CUserFieldEnum;
use DateTime;
use CTicket;
use QSoft\Client\SmsClient;
use QSoft\Entity\User;
use QSoft\Helper\BuyerLoyaltyProgramHelper;
use QSoft\Helper\ConsultantLoyaltyProgramHelper;
use QSoft\Helper\LoyaltyProgramHelper;
use QSoft\Helper\TicketHelper;
use QSoft\Notifiers\SupportTicketUpdateNotifier;
use QSoft\ORM\LegalEntityTable;

/**
 * Класс обработки событий техподдержки.
 */
class SupportEventListner
{
    // XML_ID ответа о принятии заявки
    private const ACCEPTED = 'ACCEPTED';
    // Название символьного кода почтового события.
    private const TICKET_ACCEPTION_EVENT = 'TICKET_ACCEPTION_EVENT';
    // Название символьного кода смс события.
    private const TICKET_CREATION_EVENT = 'TICKET_CREATION_EVENT';

    /**
     * Прослушивание собития OnAfterTicketUpdate
     * @param array $ticketValues
     * 
     * @return void
     */
    public function onAfterTicketUpdate(array $ticketValues): void
    {
        if ($ticketValues['UF_ACCEPT_REQUEST'] == '') {
            return;
        }

        $user = new User($ticketValues['OWNER_USER_ID']);

        if ($ticketValues['CATEGORY_ID'] > 0) {
            $category = (new CTicketDictionary())->GetByID($ticketValues['CATEGORY_ID'])->GetNext();
        }

        switch ($category['SID']) {
            case TicketHelper::CHANGE_PERSONAL_DATA_CATEGORY:
                // Событие для смены персональных данных.
                if (
                    !empty($ticketValues['UF_ACCEPT_REQUEST'])
                    && $this->isRequestAccepted($ticketValues['UF_ACCEPT_REQUEST'])
                ) {
                    $this->changeUserFields($ticketValues);
                    $ticketValues['MENTOR'] = \CUser::GetByID($ticketValues['OWNER_USER_ID'])->Fetch();
                    $rsUser = \CUser::GetList('', '', ['UF_MENTOR_ID' => $ticketValues['OWNER_USER_ID']]);
                    while($buyer = $rsUser->fetch()) {
                        $buyer  = new User($buyer['ID']);
                        $notifier = new SupportTicketUpdateNotifier($ticketValues, 'CHANGE_MENTOR_FOR_BUYERS');
                        $buyer->notification->sendNotification(
                            $notifier->getTitle(),
                            $notifier->getMessage(),
                            $notifier->getLink()
                        );
                    }

                }
                break;
            case TicketHelper::CHANGE_LEGAL_ENTITY_DATA_CATEGORY:
                if (
                    !empty($ticketValues['UF_ACCEPT_REQUEST'])
                    && $this->isRequestAccepted($ticketValues['UF_ACCEPT_REQUEST'])
                ) {
                    $this->changeLegalEntitydata($ticketValues);
                }
                break;
            case TicketHelper::BECOME_CONSULTANT_CATEGORY:
                if (
                    !empty($ticketValues['UF_ACCEPT_REQUEST'])
                    && $this->isRequestAccepted($ticketValues['UF_ACCEPT_REQUEST'])
                ) {
                    $this->becomeConsultant($ticketValues);
                }
                break;
            case TicketHelper::REGISTRATION_CATEGORY:
                // Событие для регистрации консультанта.
                if (
                    !empty($ticketValues['UF_ACCEPT_REQUEST'])
                    && $this->isRequestAccepted($ticketValues['UF_ACCEPT_REQUEST'])
                ) {
                    $this->registrateConsultant($ticketValues);
                }
                break;
            case TicketHelper::CHANGE_ROLE_CATEGORY:
                // Событие для смены роли на консультанта.
                if (
                    !empty($ticketValues['UF_ACCEPT_REQUEST'])
                    && $this->isRequestAccepted($ticketValues['UF_ACCEPT_REQUEST'])
                ) {
                    $this->changeRole($ticketValues);
                }
                break;
            case TicketHelper::CHANGE_MENTOR:
                // Событие для смены наставника.
                if (
                    !empty($ticketValues['UF_ACCEPT_REQUEST'])
                    && $this->isRequestAccepted($ticketValues['UF_ACCEPT_REQUEST'])
                ) {
                    $this->changeMentor($ticketValues);
                }
                $ticketValues['MENTOR'] = \CUser::GetByID($ticketValues['NEW_MENTOR_ID'])->Fetch();
                break;
            case TicketHelper::SUPPORT_CATEGORY:
                // Событие для техподдержки.
                break;
            default:
                break;
        }
        $notifier = new SupportTicketUpdateNotifier($ticketValues);
        $user->notification->sendNotification(
            $notifier->getTitle(),
            $notifier->getMessage(),
            $notifier->getLink()
        );
    }

    /**
     * Прослушивание собития OnAfterTicketAdd
     * @param array $ticketValues
     * 
     * @return void
     */
    public function onAfterTicketAdd(array $ticketValues): void
    {
        if ($ticketValues['CATEGORY_ID'] != null && $ticketValues['CATEGORY_ID'] <= 0) {
            $category = (new CTicketDictionary())->GetByID($ticketValues['CATEGORY_ID'])->GetNext();
        }

        $ticket
            = CTicket::GetByID($ticketValues['ID'], LANG, "Y",  "Y", "Y", ["SELECT"=>['UF_ACCEPT_REQUEST']])
                ->GetNext();
            
        $this->sendEmail(
            $this->prepareFieldsToMessageAddingTicket($ticket),
            self::TICKET_CREATION_EVENT,
            $ticket['SITE_ID']
        );

        $ticketValues['IS_NEW'] = true;
        $user = new User($ticketValues['OWNER_USER_ID']);
        $notifier = new SupportTicketUpdateNotifier($ticketValues);
        $user->notification->sendNotification(
            $notifier->getTitle(),
            $notifier->getMessage(),
            $notifier->getLink()
        );

        if ($category['SID'] != TicketHelper::SUPPORT_CATEGORY) {
            $fields = $this->prepareFieldsByMessage($ticketValues);
    
            CTicket::addMessage($ticketValues['ID'], $fields, $arrFILES);
            
            $phoneNumberToSend
                = (new \CUser)->GetList('', '', ['ID' => $ticket['RESPONSIBLE_USER_ID']])->GetNext()['PERSONAL_PHONE'];

            $message 
                = 'Создана новая заявка на ' . $category['DESCR'] . ' № ' . $ticket['ID'] . '.';

            if (!empty($phoneNumberToSend)) {
                $this->sendSMS($message, $phoneNumberToSend);
            }
        }
    }

    /**
     * Прослушивание собития OnBeforeTicketUpdate
     * @param array $ticketValues
     * 
     * @return void
     */
    public function onBeforeTicketUpdate(array $ticketValues): array
    {
        if ($ticketValues['UF_ACCEPT_REQUEST'] == '') {
            return $ticketValues;
        }

        // Получаем тикет, чтобы сравнить текущий статус($ticket) с новым ($ticketValues)
        $ticket
            = CTicket::GetByID($ticketValues['ID'], LANG, "Y",  "Y", "Y", ["SELECT"=>['UF_ACCEPT_REQUEST']])
                ->GetNext();

        if ($this->checkStatus($ticket, $ticketValues)) {
            $this->sendEmail($this->prepareFieldsToMessageAcceptionTicket($ticket), self::TICKET_ACCEPTION_EVENT, $ticket['SITE_ID']);

            $category = (new CTicketDictionary())->GetByID($ticketValues['CATEGORY_ID'])->GetNext();
            
            $acceptedStatus = (new CUserFieldEnum())
                ->GetList([], ['ID' => $ticketValues['UF_ACCEPT_REQUEST']])
                ->GetNext();

            $phoneNumberToSend
                = (new \CUser)->GetList('', '', ['ID' => $ticket['OWNER_USER_ID']])->GetNext()['PERSONAL_PHONE'];

            $message 
                = 'Ваша заявка № '
                    . $ticketValues['ID'] . ' на '
                    . $category['DESCR'] . ' ' . ($acceptedStatus == self::ACCEPTED ? 'одобрена' : 'отклонена')
                    . '. За подробной информацией обращайтесь в техподдержку';

            if (!empty($phoneNumberToSend)) {
                $this->sendSMS($message, $phoneNumberToSend);
            }
        }

        return $ticketValues; // Обязательно возвращаем данные тикета.
    }

    /**
     * @param array $ticket
     * @param array $ticketValues
     * 
     * @return bool
     */
    private function checkStatus(array $ticket, array $ticketValues): bool
    {
        if (
            isset($ticket['UF_ACCEPT_REQUEST'])
            && isset($ticketValues['UF_ACCEPT_REQUEST'])
            && $ticket['UF_ACCEPT_REQUEST'] != $ticketValues['UF_ACCEPT_REQUEST']
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param array $ticket
     * 
     * @return void
     */
    private function sendEmail(array $cFields, string $EventName, $siteId): void
    {
        EmailEvent::send([
            "EVENT_NAME" => $EventName,
            "LID" => $siteId,
            "C_FIELDS" => $cFields
        ]);
    }

    private function prepareFieldsToMessageAcceptionTicket(array $ticket)
    {
        $status = CUserFieldEnum::GetList([], ['ID' => $ticket['UF_ACCEPT_REQUEST']])->GetNext();
        $category = (new CTicketDictionary())->GetByID($ticket['CATEGORY_ID'])->GetNext();

        return [
            "TIME_SEND" => date("Y.m.d H:i:s"), // дата отправки
            "MESSAGE_SENDER" => $ticket['RESPONSIBLE_EMAIL'], // почта отправителя
            "MESSAGE_TAKER" => $ticket['OWNER_EMAIL'], // почта получателя
            "TICKET_STATUS" => $status['VALUE'], // статус заявки
            "TICKET_CATEGORY" => $category['DESCR'], // статус заявки
            "TICKET_NUMBER" => $ticket['ID'], // номер тикета
            "OWNER_NAME" => $ticket['OWNER_NAME'], // ФИО пользователя
            "RESPONSIBLE_NAME" => $ticket['RESPONSIBLE_NAME'], // ФИО пользователя
        ];
    }

    private function prepareFieldsToMessageAddingTicket(array $ticket)
    {
        $status = CUserFieldEnum::GetList([], ['ID' => $ticket['UF_ACCEPT_REQUEST']])->GetNext();
        
        if ($ticket['CATEGORY_ID'] != null && $ticket['CATEGORY_ID'] <= 0) {
            $category = (new CTicketDictionary())->GetByID($ticket['CATEGORY_ID']);
            if ($category) {
                $category = $category->GetNext();
            }
        }
        $rsSites = CSite::GetByID(SITE_ID)->Fetch();
        $siteEmail = $rsSites['EMAIL'];

        return [
            "TIME_SEND" => date("Y.m.d H:i:s"), // дата отправки
            "MESSAGE_SENDER" => $siteEmail, // почта отправителя
            "MESSAGE_TAKER" => $ticket['RESPONSIBLE_EMAIL'], // почта получателя
            "TICKET_STATUS" => $status['VALUE'], // статус заявки
            "TICKET_CATEGORY" => $category['DESCR'], // статус заявки
            "TICKET_NUMBER" => $ticket['ID'], // номер тикета
            "OWNER_NAME" => $ticket['OWNER_NAME'], // ФИО пользователя
            "RESPONSIBLE_NAME" => $ticket['RESPONSIBLE_NAME'], // ФИО пользователя
        ];
    }

    /**
     * // Отправка sms
     * @param array $ticket
     * 
     * @return void
     */
    private function sendSMS(string $message, string $phoneNumber): void
    {
        $smsClient = new SmsClient();
        $smsClient->sendMessage($message, $phoneNumber);
    }

    /**
     * Изменение пользователя
     * @param array $ticketValues
     * 
     * @return void
     */
    private function changeUserFields(array $ticketValues): void
    {
        (new User($ticketValues['OWNER_USER_ID']))->Update(json_decode($ticketValues['UF_DATA'], true));
    }

    private function changeLegalEntitydata(array $ticketValues): void
    {
        $data = json_decode($ticketValues['UF_DATA'], true);

        LegalEntityTable::update($data['id'], [
            'UF_USER_ID' => $data['user_id'],
            'UF_STATUS' => $data['type']['id'],
            'UF_DOCUMENTS' => json_encode($data['documents'], JSON_UNESCAPED_UNICODE),
        ]);
    }

    private function becomeConsultant(array $ticketValues): void
    {
        $data = json_decode($ticketValues['UF_DATA'], true);

        LegalEntityTable::add([
            'UF_USER_ID' => $data['user_id'],
            'UF_IS_ACTIVE' => true,
            'UF_STATUS' => $data['type']['id'],
            'UF_DOCUMENTS' => json_encode($data['documents'], JSON_UNESCAPED_UNICODE),
        ]);

        $userGroupId = GroupTable::getRow([
            'filter' => [
                '=STRING_ID' => 'consultant',
            ],
            'select' => ['ID'],
        ])['ID'];

        $loyaltyProgramHelper = new ConsultantLoyaltyProgramHelper;
        $firstLevel = $loyaltyProgramHelper->getLowestLevel();
        $levelsIDs = $loyaltyProgramHelper->getLevelsIDs();

        (new User($data['user_id']))->update([
            'UF_LOYALTY_LEVEL' => $levelsIDs[$firstLevel],
            'GROUP_ID' => [$userGroupId],
        ]);
    }

    /**
     * Проверяем статус принятия заявки
     * @param int $requestStatus
     * 
     * @return bool
     */
    private function isRequestAccepted(int $requestStatus): bool
    {
        $userFieldValue = (new CUserFieldEnum())
            ->GetList([], ['ID' => $requestStatus])
            ->GetNext();

        return $userFieldValue['XML_ID'] == self::ACCEPTED;
    }

    /**
     * @param array $formValues
     * 
     * @return void
     */
    private function registrateConsultant(array $ticketValues): void
    {
        $fields = json_decode($ticketValues['UF_DATA'], true);

        $user = new User($ticketValues['OWNER_USER_ID']);
        $user
            ->legalEntity
            ->create($this->prepareProps($fields['LEGAL_ENTITY'], $ticketValues['OWNER_USER_ID']));
    }

    /**
     * @param array $formValues
     * 
     * @return void
     */
    private function changeRole(array $ticketValues): void
    {
        $fields = json_decode($ticketValues['UF_DATA'], true);

        $user = new User($ticketValues['OWNER_USER_ID']);
        $groups = $user->groups;

        $user
            ->legalEntity
            ->create($this->prepareProps($fields['LEGAL_ENTITY'], $ticketValues['OWNER_USER_ID']));
        if (!$groups->isConsultant()) {
            $groups->addToGroup($groups->USER_GROUP_CONSULTANT);
        }
        if ($groups->isBuyer()) {
            $groups->removeFromGroup($groups->USER_GROUP_BUYER);
        }
    }

    /**
     * @param array $formValues
     * 
     * @return void
     */
    private function changeMentor(array $ticketValues): void
    {
        $fields = json_decode($ticketValues['UF_DATA'], true);

        $user = new User($ticketValues['OWNER_USER_ID']);

        $user->update(['UF_MENTOR_ID' => $fields['NEW_MENTOR_ID']]);
    }

    /**
     * @param mixed $formValues
     * @param mixed $userId
     * 
     * @return array
     */
    private function prepareProps(array $formValues, int $userId): array
    {
        if (!$userId) {
            return [];
        }

        $docs = [];

        foreach ($formValues as $key => $row) {
            if ($key == 'UF_STATUS') {
                $props["UF_STATUS"] = $row;
            } else {
                array_set($docs, $key, $row);
            }
        }

        $props['UF_USER_ID'] = $userId;
        $props['UF_CREATED_AT'] = new DateTime();
        $props['UF_DOCUMENTS'] = json_encode($docs, JSON_UNESCAPED_UNICODE);
        $props['UF_IS_ACTIVE'] = true;

        return $props;
    }

    /**
     * @param array $ticketValues
     * 
     * @return array
     */
    private function prepareFieldsByMessage(array $ticketValues): array
    {
        $protocol = $this->getProtocol();

        return [
            "TICKET_ID" => $ticketValues['ID'],
            "IS_HIDDEN" => "Y",
            "IS_LOG" => "N",
            "IS_OVERDUE" => "N",
            "CURRENT_RESPONSIBLE_USER_ID" => $ticketValues["RESPONSIBLE_USER_ID"],
            "NOTIFY_AGENT_DONE" => "N",
            "EXPIRE_AGENT_DONE" => "N",
            "MESSAGE" => "
            Ссылка на детальную страницу заявки: "
                . $protocol 
                . $_SERVER['HTTP_HOST']
                . '/bitrix/admin/personal_data.php?ID='
                . $ticketValues["ID"],
            "MESSAGE_SEARCH" => "",
            "IS_SPAM" => null,
            "EXTERNAL_ID" => null,
            "EXTERNAL_FIELD_1" => "",
            "OWNER_USER_ID" => $ticketValues["OWNER_USER_ID"],
            "OWNER_GUEST_ID" => null,
            "OWNER_SID" => "",
            "SOURCE_ID" => null,
            "CREATED_USER_ID" => $ticketValues["OWNER_USER_ID"],
            "CREATED_GUEST_ID" => "",
            "CREATED_MODULE_NAME" => "support",
            "MODIFIED_USER_ID" => "",
            "MODIFIED_GUEST_ID" => "",
            "MESSAGE_BY_SUPPORT_TEAM" => "N",
            "TASK_TIME" => null,
            "NOT_CHANGE_STATUS" => "N",
            "SLA_ID" => $ticketValues["SLA_ID"],
            "SOURCE_NAME" => null,
            "OWNER_EMAIL" => $ticketValues["OWNER_EMAIL"],
            "OWNER_LOGIN" => $ticketValues["OWNER_LOGIN"],
            "OWNER_NAME" => $ticketValues["OWNER_NAME"],
            "LOGIN" => $ticketValues["OWNER_LOGIN"],
            "NAME" => $ticketValues["OWNER_NAME"],
            "CREATED_EMAIL" => $ticketValues["OWNER_EMAIL"],
            "CREATED_LOGIN" => $ticketValues["OWNER_LOGIN"],
            "CREATED_NAME" => $ticketValues["OWNER_NAME"],
        ];
    }

    /**
     * Возвращает текущий протокол http
     *
     * @return string
     * 
     */
    private function getProtocol(): string
    {
        return (
            !empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] !== 'off'
            || $_SERVER['SERVER_PORT'] == 443
        ) ? "https://" : "http://";
    }
}
