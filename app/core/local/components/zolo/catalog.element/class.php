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

                $fileIds = [];
                $this->arResult['PRODUCT'] = $product;

                if ($product['PREVIEW_PICTURE']) {
                    $fileIds[] = $product['PREVIEW_PICTURE'];
                }
                if ($product['DETAIL_PICTURE']) {
                    $fileIds[] = $product['DETAIL_PICTURE'];
                }
                if ($product['PROPERTY_MORE_PHOTO_VALUE']) {
                    $fileIds[] = $product['PROPERTY_MORE_PHOTO_VALUE'];
                }

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
                            if ($offer['PREVIEW_PICTURE']) {
                                $fileIds[] = $offer['PREVIEW_PICTURE'];
                            }
                            if ($offer['DETAIL_PICTURE']) {
                                $fileIds[] = $offer['DETAIL_PICTURE'];
                            }
                            if ($offer['PROPERTY_MORE_PHOTO_VALUE']) {
                                $fileIds[] = $offer['PROPERTY_MORE_PHOTO_VALUE'];
                            }
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
}
