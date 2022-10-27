<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\FaqTable;

class FaqComponent extends CBitrixComponent
{

    public function executeComponent()
    {
        try {
            $this->checkModules();
            $this->getResult();
            $this->includeComponentTemplate();
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }

    /**
     * @throws LoaderException
     * @throws SystemException
     */
    public function checkModules()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new SystemException(Loc::GetMessage('PSETTINGS_HLBLOCK_NOT_INCLUDED'));
        }
    }

    public function getResult()
    {
        $groups = [];

        $group = FaqTable::getFieldValues(['UF_GROUP'])['UF_GROUP'];
        foreach ($group as $row) {
            $groups[$row['ID']] = $row['VALUE'];
        }

        $hlBlock = FaqTable::getList([
            'order' => ['ID' => 'ASC'],
            'select' => ['*'],
        ]);
        while ($fields = $hlBlock->Fetch()) {
            $this->arResult['GROUPS'][$fields['UF_GROUP']] = $groups[$fields['UF_GROUP']];
            $this->arResult['QUESTIONS'][$fields['UF_GROUP']][$fields['ID']] = $fields;
        }
    }
}
