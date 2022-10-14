<?php

namespace Bitrix\additionalsupport;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use \CTicket;

class FormHandler
{
    /**
     * @param int $id
     * 
     * @return array
     */
    public function GetFormData(int $id): array
    {
        $this->initModule();
        
        $ticket = CTicket::GetByID($id, LANG, "Y",  "Y", "Y", ["SELECT"=>['UF_DATA']])->GetNext();

        if (!is_array(unserialize($ticket['~UF_DATA']))) {
            return [];
        }

        return $this->prepareFields(unserialize($ticket['~UF_DATA']));
    }

    /**
     * @return void
     * @throw SystemException
     */
    private function initModule(): void
    {
        if (!Loader::includeModule('support')) {
            throw new SystemException(Loc::GetMessage('SUPPORT_NOT_INCLUDED'));
        }
    }

    /**
     * @param array $arrValues
     * 
     * @return array
     */
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
