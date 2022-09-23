<?php

use Bitrix\Main;
use	Bitrix\Main\Loader;
use	Bitrix\Main\Localization\Loc;
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
    private bool $isError = false;
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
            $this->isError = true;

            return $arParams;
        }

        $arParams['IBLOCK_ID'] = (int)(trim($arParams['IBLOCK_ID']) ?? 0);
        if (!$arParams['IBLOCK_ID']) {
            Tools::process404(Loc::getMessage('IBLOCK_ID_NOT_SET'), false, false);
            $this->isError = true;

            return $arParams;
        }

        $arParams['ELEMENT_ID'] = (int)(trim($arParams['ELEMENT_ID']) ?? 0);
        $arParams['ELEMENT_CODE'] = trim($arParams['ELEMENT_CODE'] ?? '');
        if (!$arParams['ELEMENT_ID'] && !$arParams['ELEMENT_CODE']) {
            Tools::process404(Loc::getMessage('ELEMENT_DATA_NOT_SET'), false, false);
            $this->isError = true;

            return $arParams;
        }

        $arParams['SECTION_ID'] = (int)(trim($arParams['SECTION_ID']) ?? 0);
        $arParams['SECTION_CODE'] = trim($arParams['SECTION_CODE'] ?? '');

		return $arParams;
	}

    public function executeComponent()
    {
        try {
            if ($this->isError) {
                return;
            }

            if (!Loader::includeModule('iblock') || !Loader::includeModule('catalog')) {
                throw new Main\LoaderException(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
            }

            if ($this->startResultCache()) {
                if (CIBlockType::GetList([], ['=ID' => $this->arParams['IBLOCK_TYPE']])->SelectedRowsCount() <= 0) {
                    throw new Main\LoaderException(Loc::getMessage('IBLOCK_TYPE_NOT_SET'));
                }

                if (CIBlock::GetList([], ['=ID' => $this->arParams['IBLOCK_ID']])->SelectedRowsCount() <= 0) {
                    throw new Main\LoaderException(Loc::getMessage('IBLOCK_ID_NOT_SET'));
                }

                $baseSelect = [
                    'ID',
                    'NAME',
                    'CODE',
                    'DETAIL_PAGE_URL',
                    'PREVIEW_PICTURE',
                    'DETAIL_PICTURE',
                    'DETAIL_TEXT',
                    'DETAIL_TEXT_TYPE',
                    'PREVIEW_TEXT',
                    'PREVIEW_TEXT_TYPE',
                ];

                $arFilter = [
                    'IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
                    'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                    'ACTIVE' => 'Y',
                    'SECTION_ID' => $this->arParams['SECTION_ID'],
                    'SECTION_CODE' => $this->arParams['SECTION_CODE'],
                ];

                if ($this->arParams['ELEMENT_ID']) {
                    $arFilter['ID'] = $this->arParams['ELEMENT_ID'];
                } else {
                    $arFilter['CODE'] = $this->arParams['ELEMENT_CODE'];
                }

                $arSelect = $baseSelect;
                CIBlockElement::GetPropertyValuesArray($properties, $this->arParams['IBLOCK_ID'], $arFilter);
                if (!empty($properties)) {
                    $arSelect = array_merge($arSelect, $this->getPropertyKeys($properties));
                }

                $product = CIBlockElement::GetList([], $arFilter, false, false, $arSelect)->Fetch();
                if (!$product) {
                    Tools::process404(Loc::getMessage('ELEMENT_NOT_FOUND'));
                    return;
                }

                $this->arResult['PRODUCT'] = $product;

                $fileIds = $this->getFilesByItem($product);

                $offersResult = CCatalogSKU::getOffersList($product['ID'], $this->arParams['IBLOCK_ID'], [], ['IBLOCK_ID']);
                $offers = [];
                if (!empty($offersResult) && !empty(current($offersResult))) {
                    $arSelect = $baseSelect;
                    $offersIblockIds = array_unique(array_column(current($offersResult), 'IBLOCK_ID'));
                    foreach ($offersIblockIds as $item) {
                        $properties = [];
                        CIBlockElement::GetPropertyValuesArray($properties, $item, []);

                        $keys = $this->getPropertyKeys($properties);
                        $arSelect = array_merge($arSelect, $keys);

                        $currentOffers = CCatalogSKU::getOffersList($product['ID'], $this->arParams['IBLOCK_ID'], [], $arSelect);
                        $offers = array_merge($offers, current($currentOffers));

                        foreach (current($currentOffers) as $offer) {
                            $fileIds = array_merge($fileIds, $this->getFilesByItem($offer));
                        }
                    }
                }

                $itemFilter = ['@ID' => implode(',', array_unique($fileIds))];
                $fileIterator = CFile::GetList([], $itemFilter);
                while ($file = $fileIterator->Fetch()) {
                    $file['SRC'] = CFile::GetFileSRC($file);
                    $this->arResult['FILES'][$file['ID']] = $file;
                }

                $this->arResult['OFFERS'] = $offers;

                $buttons = CIBlock::GetPanelButtons(
                    $this->arParams['IBLOCK_ID'],
                    $product['ID'],
                    0,
                    ['SECTION_BUTTONS' => true, 'SESSID' => false]
                );

                $this->arResult['EDIT_LINK'] = $buttons['edit']['edit_element']['ACTION_URL'];
                $this->arResult['DELETE_LINK'] = $buttons['edit']['delete_element']['ACTION_URL'];

                $this->setResultCacheKeys([]);
            }

            $basketFilter = [
                'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                'LID' => SITE_ID,
            ];
            $basketIterator = CSaleBasket::GetList([], $basketFilter, false, false, ['*']);

            $basketInfo = [];
            $productIdsString = array_column($this->arResult['OFFERS'], 'ID');
            while($basket = $basketIterator->Fetch()) {
                if (in_array($basket['PRODUCT_ID'], $productIdsString)) {
                    $basketInfo[$basket['PRODUCT_ID']] = $basket;
                }
            }
            $this->arResult['BASKET'] = $basketInfo;

            $this->includeComponentTemplate();
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }

    private function getPropertyKeys(array $properties): array
    {
        return array_map(static function ($item) {
            return "PROPERTY_{$item}";
        }, array_keys(current($properties)));
    }

    private function getFilesByItem(array $item): array
    {
        $result = [];
        if (isset($item['PREVIEW_PICTURE']) && $item['PREVIEW_PICTURE']) {
            $result[] = $item['PREVIEW_PICTURE'];
        }
        if (isset($item['DETAIL_PICTURE']) && $item['DETAIL_PICTURE']) {
            $result[] = $item['DETAIL_PICTURE'];
        }
        if (isset($item['PROPERTY_MORE_PHOTO_VALUE']) && $item['PROPERTY_MORE_PHOTO_VALUE']) {
            $result[] = $item['PROPERTY_MORE_PHOTO_VALUE'];
        }

        return $result;
    }
}
