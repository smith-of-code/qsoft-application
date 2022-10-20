<?php

namespace Bitrix\zolo;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use Bitrix\Report\VisualConstructor\Fields\Div;
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

        return json_decode($ticket['~UF_DATA'], true);
    }

    /**
     * @return void
     * @throws SystemException
     */
    private function initModule(): void
    {
        if (!Loader::includeModule('support')) {
            throw new SystemException(Loc::GetMessage('SUPPORT_NOT_INCLUDED'));
        }

        if (!Loader::includeModule('report')) {
            throw new SystemException(Loc::GetMessage('SUPPORT_NOT_INCLUDED'));
        }
    }

    /**
     * @param array $arrValues
     * 
     * @return string
     */
    public function prepareFields(array $arrValues): string
    {
        $html = new Div();
        $start = (new Div())->start()->getContent();
        $end = (new Div())->end()->getContent();
        $indent = '<br>';
        $fields = '';

        foreach ($arrValues as $key => $value) {
            if (is_array($value)) { 
                $fields 
                    .=  $indent .  $indent . $start
                    . $this->getBolderText($key) . ': '
                    . $end . $this->prepareFields($value, $key);
            } else {
                $fields .= $start . $key . ': ' . $value . $end;
            }
        }

        return $fields;
    }

    /**
     * @param mixed $content
     * 
     * @return string
     */
    private function getBolderText($content): string
    {
        return '<b>' . $content . '</b>';
    }
}
