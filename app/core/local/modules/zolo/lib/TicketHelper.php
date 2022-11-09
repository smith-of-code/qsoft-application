<?php

namespace Bitrix\Zolo;

use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use CTicket;

class TicketHelper
{
    /**
     * @throws LoaderException
     * @throws SystemException
     */
    public function __construct()
    {
        $this->initModule();
    }

    /**
     * @throws LoaderException
     * @throws SystemException
     */
    private function initModule(): void
    {
        if (!Loader::includeModule('support')) {
            throw new SystemException(Loc::GetMessage('SUPPORT_NOT_INCLUDED'));
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function getTicketData(int $id): array
    {
        $rsTicket = CTicket::GetByID($id, LANG, 'Y',  'Y', 'Y', ['SELECT' => ['UF_DATA']]);

        if (!$arTicket = $rsTicket->GetNext()) {
            return [];
        }

        return json_decode($arTicket['~UF_DATA'], true) ?? [];
    }
}
