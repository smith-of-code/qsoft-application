<?php

namespace QSoft\Events;

use Bitrix\Main\Mail\Event as EmailEvent;
use Bitrix\Main\Sms\Event as SmsEvent;
use \CTicketDictionary;
use \CUserFieldEnum;
use DateTime;
use CTicket;
use QSoft\Entity\User;

/**
 * Класс обработки событий техподдержки.
 */
class SupportEventListner
{
    // Коды категорий
    private const CHANGE_OF_PERSONAL_DATA = 'CHANGE_OF_PERSONAL_DATA';
    private const REGISTRATION = 'REGISTRATION';
    private const CHANGE_ROLE = 'CHANGE_ROLE';
    private const SUPPORT = 'SUPPORT';
    // XML_ID ответа о принятии заявки 
    private const ACCEPTED = 'ACCEPTED';
    // Название символьного кода почтового события.
    private const TICKET_ACCEPTION_EVENT = 'TICKET_ACCEPTION_EVENT';
    // Название символьного кода почтового события.
    private const TICKET_ACCEPTION_EVENT_SMS = 'TICKET_ACCEPTION_EVENT_SMS';

    /**
     * Прослушивание собития OnAfterTicketUpdate
     * @param array $ticketValues
     * 
     * @return void
     */
    public function onAfterTicketUpdate(array $ticketValues): void
    {
        if ($ticketValues['CATEGORY_ID'] > 0) {
            $category = (new CTicketDictionary())->GetByID($ticketValues['CATEGORY_ID'])->GetNext();
        }

        switch ($category['SID']) {
            case self::CHANGE_OF_PERSONAL_DATA:
                // Событие для смены персональных данных.
                if (
                    !empty($ticketValues['UF_ACCEPT_REQUEST'])
                    && $this->isRequestAccepted($ticketValues['UF_ACCEPT_REQUEST'])
                ) {
                    $this->changeUserFields($ticketValues);
                }
                break;
            case self::REGISTRATION:
                // Событие для регистрации консультанта.
                if (
                    !empty($ticketValues['UF_ACCEPT_REQUEST'])
                    && $this->isRequestAccepted($ticketValues['UF_ACCEPT_REQUEST'])
                ) {
                    $this->registrateConsultant($ticketValues);
                }
                break;
            case self::CHANGE_ROLE:
                // Событие для смены роли на консультанта.
                if (
                    !empty($ticketValues['UF_ACCEPT_REQUEST'])
                    && $this->isRequestAccepted($ticketValues['UF_ACCEPT_REQUEST'])
                ) {
                    $this->changeRole($ticketValues);
                }
                break;
            case self::SUPPORT:
                // Событие для техподдержки.
                break;
            default:
                break;
        }
    }

    /**
     * Прослушивание собития OnAfterTicketAdd
     * @param array $ticketValues
     * 
     * @return void
     */
    public function onAfterTicketAdd(array $ticketValues): void
    {
        $category = (new CTicketDictionary())->GetByID($ticketValues['CATEGORY_ID'])->GetNext();

        if (
            $category['SID'] == self::CHANGE_OF_PERSONAL_DATA
            || $category['SID'] == self::CHANGE_OF_PERSONAL_DATA
        ) {
            $fields = $this->prepareFieldsByMessage($ticketValues);
    
            CTicket::addMessage($ticketValues['ID'], $fields, $arrFILES);
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
        // Получаем тикет, чтобы сравнить текущий статус($ticket) с новым ($ticketValues)
        $ticket
            = CTicket::GetByID($ticketValues['ID'], LANG, "Y",  "Y", "Y", ["SELECT"=>['UF_ACCEPT_REQUEST']])
                ->GetNext();

        if ($this->checkStatus($ticket, $ticketValues)) {
            $this->sendEmail($ticket);
            $this->sendSMS($ticket);
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
    private function sendEmail(array $ticket): void
    {
        $status = CUserFieldEnum::GetList([], ['ID' => $ticket['UF_ACCEPT_REQUEST']])->GetNext();

        EmailEvent::send([
            "EVENT_NAME" => self::TICKET_ACCEPTION_EVENT,
            // Константа SITE_ID в админке передает значение "ru", 
            // что  не подходит для отправки письма, нужен "s1", его можно получить из тикета.
            "LID" => $ticket['SITE_ID'],
            "C_FIELDS" => [
                "TIME_SEND" => date("Y.m.d H:i:s"), // дата отправки
                "MESSAGE_SENDER" => $ticket['RESPONSIBLE_EMAIL'], // почта отправителя
                "MESSAGE_TAKER" => $ticket['OWNER_EMAIL'], // почта получателя
                "TICKED_STATUS" => $status['VALUE'], // статус заявки
                "TICKED_NUMBER" => $ticket['ID'], // номер тикета
                "OWNER_NAME" => $ticket['OWNER_NAME'], // ФИО пользователя
                "RESPONSIBLE_NAME" => $ticket['RESPONSIBLE_NAME'], // ФИО пользователя
            ]
        ]);
    }

    /**
     * // Отправка sms
     * @param array $ticket
     * 
     * @return void
     */
    private function sendSMS(array $ticket): void
    {
        $status = CUserFieldEnum::GetList([], ['ID' => $ticket['UF_ACCEPT_REQUEST']])->GetNext();

        $users = [
            $ticket['OWNER_USER_ID'],
            $ticket['RESPONSIBLE_USER_ID'],
        ];

        $user = (new \CUser)->GetList('', '', ['ID' => implode('|', $users)], ['PHONE_NUMBER']);

        $owner = [];
        $responsible = [];

        while ($res = $user->GetNext()) {
            if ($res['ID'] == $ticket['OWNER_USER_ID']) {
                $owner = $res;
            } else {
                $responsible = $res;
            }
        }

        $fields = [
            "TIME_SEND" => date("Y.m.d H:i:s"), // дата отправки
            "MESSAGE_SENDER" => '+79042356440', // почта отправителя
            "MESSAGE_TAKER" => '+79042356440', // почта получателя
            "TICKED_STATUS" => $status['VALUE'], // статус заявки
            "TICKED_NUMBER" => $ticket['ID'], // номер тикета
            "OWNER_NAME" => $ticket['OWNER_NAME'], // ФИО пользователя
            "RESPONSIBLE_NAME" => $ticket['RESPONSIBLE_NAME'], // ФИО пользователя
        ];

        $sms = new SmsEvent(self::TICKET_ACCEPTION_EVENT_SMS, $fields);

        $sms->setSite($ticket['SITE_ID'])
            ->setLanguage(SITE_ID)
            ->send();
    }

    /**
     * Изменение пользователя
     * @param array $ticketValues
     * 
     * @return void
     */
    private function changeUserFields(array $ticketValues): void
    {
        $fields = json_decode($ticketValues['UF_DATA'], true);
        $user = new User($ticketValues['OWNER_USER_ID']);
        $user->Update($fields['USER_INFO']);
        $user->legalEntity->update($ticketValues['LEGAL_ENTITY']);
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
                . '/bitrix/admin/applocation_detail.php?ID='
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

    private function getProtocol(): string
    {
        return (
            !empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] !== 'off'
            || $_SERVER['SERVER_PORT'] == 443
        ) ? "https://" : "http://";
    }
}
