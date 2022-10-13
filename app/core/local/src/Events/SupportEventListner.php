<?php

namespace QSoft\Events;

use QSoft\ORM\LegalEntityTable;
use \CTicketDictionary;
use \CUserFieldEnum;
use DateTime;
use CTicket;
use \CUser;

/**
 * Класс обработки событий техподдержки.
 */
class SupportEventListner
{
    private const CHANGE_OF_PERSONAL_DATA = 'CHANGE_OF_PERSONAL_DATA';
    private const REGISTRATION = 'REGISTRATION';
    private const SUPPORT = 'SUPPORT';
    private const CHANGE_ROLE = 'CHANGE_ROLE';
    private const ACCEPTED = 'ACCEPTED';

    /**
     * Прослушивание собития OnAfterTicketUpdate
     * @param array $ticketValues
     * 
     * @return void
     */
    public function onAfterTicketUpdate(array $ticketValues): void
    {
        $category = (new CTicketDictionary())->GetByID($ticketValues['CATEGORY_ID'])->GetNext();

        switch ($category['SID']) {
            case self::CHANGE_OF_PERSONAL_DATA:
                // Событие для смены персональных данных.
                $this->changeUserFields($ticketValues);
                break;
            case self::REGISTRATION:
                // Событие для регистрации консультанта.
                $this->registrateConsultant($ticketValues);
                break;
            case self::CHANGE_ROLE:
                // Событие для смены роли.
                break;
            case self::SUPPORT:
                // Событие для техподдержки.
                break;
        }
    }

    public function OnAfterTicketAdd(array $ticketValues): void
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
     * Изменение пользователя
     * @param array $ticketValues
     * 
     * @return void
     */
    private function changeUserFields(array $ticketValues): void
    {
        if ($this->isRequestAcepted($ticketValues['UF_ACCEPT_REQUEST'])) {
            $fields = unserialize($ticketValues['UF_DATA']);

            (new CUser())->Update($ticketValues['OWNER_USER_ID'], $fields);

            LegalEntityTable::update($ticketValues['OWNER_USER_ID'], $this->prepareProps($fields, $ticketValues['OWNER_USER_ID']));
        }
    }

    /**
     * Проверяем статус принятия заявки
     * @param int $requestStatus
     * 
     * @return bool
     */
    private function isRequestAcepted(int $requestStatus): bool
    {
        $userFieldValue = (new CUserFieldEnum())
            ->GetList([], ['ID' => $requestStatus])
            ->GetNext();

        return  $userFieldValue['XML_ID'] == self::ACCEPTED;
    }

    /**
     * @param mixed $formValues
     * @param mixed $userId
     * 
     * @return void
     */
    private function registrateConsultant($ticketValues): void
    {
        if ($this->isRequestAcepted($ticketValues['UF_ACCEPT_REQUEST'])) {
            $fields = unserialize($ticketValues['UF_DATA']);

            LegalEntityTable::add(
                $this->prepareProps($fields, $ticketValues['OWNER_USER_ID'])
            );
        }
    }

    /**
     * @param mixed $formValues
     * @param mixed $userId
     * 
     * @return array
     */
    private function prepareProps($formValues, $userId): array
    {
        $docs = [];

        foreach ($formValues as $row) {
            switch ($row['name']) {
                case 'UF_STATUS':
                    $props['UF_STATUS'] = $row['value'];
                    break;
                case 'citizenship':
                    $docs['citizenship'] = $row['value'];
                    break;
                case 'passport.series':
                    $docs['passport']['series'] = $row['value'];
                    break;
                case 'passport.number':
                    $docs['passport']['number'] = $row['value'];
                    break;
                case 'passport.issued':
                    $docs['passport']['issued'] = $row['value'];
                    break;
                case 'passport.date':
                    $docs['passport']['date'] = $row['value'];
                    break;
                case 'passport.addressRegistration.locality':
                    $docs['passport']['addressRegistration']['locality'] = $row['value'];
                    break;
                case 'passport.addressRegistration.street':
                    $docs['passport']['addressRegistration']['street'] = $row['value'];
                    break;
                case 'passport.addressRegistration.home':
                    $docs['passport']['addressRegistration']['home'] = $row['value'];
                    break;
                case 'passport.addressRegistration.flat':
                    $docs['passport']['addressRegistration']['flat'] = $row['value'];
                    break;
                case 'passport.addressRegistration.index':
                    $docs['passport']['addressRegistration']['index'] = $row['value'];
                    break;
                case 'passport.addressFact':
                    $docs['passport']['addressFact'] = $row['value'];
                    break;
                case 'passport.addressFact.locality':
                    $docs['passport']['addressFact']['locality'] = $row['value'];
                    break;
                case 'passport.addressFact.street':
                    $docs['passport']['addressFact']['street'] = $row['value'];
                    break;
                case 'passport.addressFact.home':
                    $docs['passport']['addressFact']['home'] = $row['value'];
                    break;
                case 'passport.addressFact.flat':
                    $docs['passport']['addressFact']['flat'] = $row['value'];
                    break;
                case 'passport.addressFact.index':
                    $docs['passport']['addressFact']['index'] = $row['value'];
                    break;
                case 'passport.addressOrganization.locality':
                    $docs['passport']['addressOrganization']['locality'] = $row['value'];
                    break;
                case 'passport.addressOrganization.street':
                    $docs['passport']['addressOrganization']['street'] = $row['value'];
                    break;
                case 'passport.addressOrganization.home':
                    $docs['passport']['addressOrganization']['home'] = $row['value'];
                    break;
                case 'passport.addressOrganization.flat':
                    $docs['passport']['addressOrganization']['flat'] = $row['value'];
                    break;
                case 'passport.addressOrganization.index':
                    $docs['passport']['addressOrganization']['index'] = $row['value'];
                    break;
                case 'passport.copyPassport':
                    $docs['passport']['copyPassport'][] = $row['value'];
                    break;
                case 'inn':
                    $docs['inn'] = $row['value'];
                    break;
                case 'kpp':
                    $docs['kpp'] = $row['value'];
                    break;
                case 'innFiles':
                    $docs['innFiles'][] = $row['value'];
                    break;
                case 'bank.name':
                    $docs['bank']['name'] = $row['value'];
                    break;
                case 'bank.bik':
                    $docs['bank']['bik'] = $row['value'];
                    break;
                case 'bank.rAccount':
                    $docs['bank']['rAccount'] = $row['value'];
                    break;
                case 'bank.kAccount':
                    $docs['bank']['kAccount'] = $row['value'];
                    break;
                case 'bank.bankFiles':
                    $docs['bank']['bankFiles'][] = $row['value'];
                    break;
                case 'nds':
                    $docs['nds'] = $row['value'];
                    break;
                case 'usn':
                    $docs['usn'][] = $row['value'];
                    break;
                case 'ogrnip':
                    $docs['ogrnip'] = $row['value'];
                    break;
                case 'egrip':
                    $docs['egrip'][] = $row['value'];
                    break;
                case 'name':
                    $docs['name'] = $row['value'];
                    break;
                case 'nameSmall':
                    $docs['nameSmall'] = $row['value'];
                    break;
                case 'ogrn':
                    $docs['ogrn'] = $row['value'];
                    break;
                case 'rule':
                    $docs['rule'][] = $row['value'];
                    break;
                case 'leader':
                    $docs['leader'][] = $row['value'];
                    break;
                case 'order':
                    $docs['order'] = $row['value'];
                    break;
                case 'egrul':
                    $docs['egrul'][] = $row['value'];
                    break;
                case 'rightToSign':
                    $docs['rightToSign'] = $row['value'];
                    break;
            }
        }

        $props['UF_USER_ID'] = $userId;
        $props['UF_CREATED_AT'] = new DateTime();
        $props['UF_DOCUMENTS'] = json_encode($docs, JSON_UNESCAPED_UNICODE);
        $props['UF_IS_ACTIVE'] = true;

        return $props;
    }

    private function prepareFieldsByMessage($ticketValues): array
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
                ссылка на детальную страницу с сериализованными данными:
                " . $protocol 
                    . $_SERVER['HTTP_HOST']
                    . '/bitrix/admin/request_form.php?ID='
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
