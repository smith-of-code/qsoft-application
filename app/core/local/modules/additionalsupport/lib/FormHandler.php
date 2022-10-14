<?php

namespace Bitrix\additionalsupport;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use \CTicket;
use CTicketDictionary;

class FormHandler
{
    public function GetFormData(int $id)
    {
        $this->initModule();
        
        $ticket = CTicket::GetByID($id, LANG, "Y",  "Y", "Y", ["SELECT"=>['UF_DATA']])->GetNext();

        if (!is_array(unserialize($ticket['~UF_DATA']))) {
            return [];
        }

        return $this->prepareFields(unserialize($ticket['~UF_DATA']));
    }

    private function initModule()
    {
        if (!Loader::includeModule('support')) {
            throw new SystemException(Loc::GetMessage('SUPPORT_NOT_INCLUDED'));
        }
    }

    private function prepareFields(array $arrValues): array
    {
        foreach ($arrValues as $key => $value) {
            if (is_array($value)) {
                $this->prepareFields($value);
                continue;
            }
            $fields[$key] = $value;
        }
        return $fields ?? [];
    }
}