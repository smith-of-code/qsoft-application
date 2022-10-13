<?php

namespace Bitrix\additionalsupport;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use \CTicket;
use CUserTypeEntity;

class FormHandler
{
    public function GetFormData(int $id)
    {
        $this->initModule();

        $ticket = CTicket::GetByID($id, LANG, "Y",  "Y", "Y", ["SELECT"=>['UF_DATA']])->GetNext();

        return unserialize($ticket['~UF_DATA']);
    }

    private function initModule()
    {
        if (!Loader::includeModule('support')) {
            throw new SystemException(Loc::GetMessage('SUPPORT_NOT_INCLUDED'));
        }
    }
}