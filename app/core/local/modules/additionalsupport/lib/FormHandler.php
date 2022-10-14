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

        if (!is_array(json_decode($ticket['~UF_DATA'], true))) {
            return [];
        }

        return $this->prepareFields(json_decode($ticket['~UF_DATA'], true));
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
    private function prepareFields(array $arrValues, string $mergedKey = null): array
    {
        $fields = [];
        foreach ($arrValues as $key => $value) {
            if (is_array($value)) {
                $fields = array_merge($fields, $this->prepareFields($value, $key));
                continue;
            }

            $fields[$mergedKey . ' ' . $key] = $value;
        }

        return $fields;
    }
}
