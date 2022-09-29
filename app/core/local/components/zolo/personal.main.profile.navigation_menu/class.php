<?php

use Bitrix\Main;
use	Bitrix\Main\Loader;
use	Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\Component\Tools;
use Bitrix\Catalog\PriceTable;

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

Loc::loadMessages(__FILE__);

if (!Loader::includeModule('highloadblock')) {
    ShowError(Loc::getMessage('HIGHLOADBLOCK_MODULE_NOT_INSTALLED'));
    return;
}

class PersonalMainProfileNavigationMenu extends CBitrixComponent
{
    private bool $isError = false;

    public function executeComponent()
    {
        try {
            if ($this->isError) {
                return;
            }

            if (!defined(''))

            $this->includeComponentTemplate();
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }
}
