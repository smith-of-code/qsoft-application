<?php

namespace QSoft\Events;

use \CTicketDictionary;
use \CUserFieldEnum;
use \CUser;
use QSoft\ORM\LegalEntityTable;

/**
 * Класс обработки событий техподдержки.
 */
class SupportEventListner
{
    private const CHANGE_OF_PERSONAL_DATA = 'CHANGE_OF_PERSONAL_DATA';
    private const REGISTRATION = 'REGISTRATION';
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

        if ($category['SID'] == self::CHANGE_OF_PERSONAL_DATA) {
            // Заявка на изменение полей
            $this->changeUserFields($ticketValues);

        } elseif ($category['SID'] == self::REGISTRATION) {
            // Заявка на регистрацию консультанта
            $this->registrateConsultant($ticketValues);
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

            LegalEntityTable::update($ticketValues['OWNER_USER_ID'], $fields);

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
        $userFieldValue = (new CUserFieldEnum())->GetList([], ['ID' => $requestStatus])->GetNext();

        return  $userFieldValue['XML_ID'] == self::ACCEPTED;
    }

    private function registrateConsultant($ticketValues)
    {
        LegalEntityTable::add($fields);
    }
}