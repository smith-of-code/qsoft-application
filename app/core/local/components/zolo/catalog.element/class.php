<?php

use Bitrix\Main;
use	Bitrix\Main\Loader;
use	Bitrix\Main\Localization\Loc;
use	Bitrix\Catalog;
use Bitrix\Iblock\Component\Tools;

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

Loc::loadMessages(__FILE__);

if (!Loader::includeModule('iblock'))
{
	ShowError(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
	return;
}

class CatalogElementComponent extends CBitrixComponent
{
	/**
	 * @param array $arParams
	 * @return array
	 */
	public function onPrepareComponentParams($arParams): array
	{
		$arParams = parent::onPrepareComponentParams($arParams);

        $arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE'] ?? '');
        if (!$arParams['IBLOCK_TYPE']) {
            Tools::process404(Loc::getMessage('IBLOCK_TYPE_NOT_SET'), false, false);
            $arParams['.ERROR'] = true;

            return $arParams;
        }

        $arParams['IBLOCK_ID'] = (int)(trim($arParams['IBLOCK_ID']) ?? 0);
        if (!$arParams['IBLOCK_ID']) {
            Tools::process404(Loc::getMessage('IBLOCK_ID_NOT_SET'), false, false);
            $arParams['.ERROR'] = true;

            return $arParams;
        }

        $arParams['ELEMENT_ID'] = (int)(trim($arParams['ELEMENT_ID']) ?? 0);
        $arParams['ELEMENT_CODE'] = trim($arParams['ELEMENT_CODE'] ?? '');
        if (!$arParams['ELEMENT_ID'] && !$arParams['ELEMENT_CODE']) {
            Tools::process404(Loc::getMessage('ELEMENT_DATA_NOT_SET'), false, false);
            $arParams['.ERROR'] = true;

            return $arParams;
        }

        $arParams['SECTION_ID'] = (int)(trim($arParams['SECTION_ID']) ?? 0);
        $arParams['SECTION_CODE'] = trim($arParams['SECTION_CODE'] ?? '');

		return $arParams;
	}
}
