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

                $product = $this->getProduct($baseSelect);
                $this->arResult['PRODUCT'] = $product;

                $fileIds = $this->getFilesByItem($product);

                $offers = $this->getOffers($product['ID'], $baseSelect, $fileIds);
                $this->arResult['OFFERS'] = $offers;

                $itemFilter = ['@ID' => implode(',', array_unique($fileIds))];
                $fileIterator = CFile::GetList([], $itemFilter);
                while ($file = $fileIterator->Fetch()) {
                    $file['SRC'] = CFile::GetFileSRC($file);
                    $this->arResult['FILES'][$file['ID']] = $file;
                }

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
            $this->arResult = $this->transformData($this->arResult);

            $this->includeComponentTemplate();
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }

    private function getProduct(array $arSelect): array
    {
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

        CIBlockElement::GetPropertyValuesArray($properties, $this->arParams['IBLOCK_ID'], $arFilter);
        if (!empty($properties)) {
            $arSelect = array_merge($arSelect, $this->getPropertyKeys($properties));
        }

        $product = CIBlockElement::GetList([], $arFilter, false, false, $arSelect)->Fetch();
        if (!$product) {
            throw new RuntimeException(Loc::getMessage('ELEMENT_NOT_FOUND'));
        }

        $productPrice = PriceTable::getList([
            'filter' => ['PRODUCT_ID' => $product['ID']],
        ])->fetch();
        if ($productPrice) {
            $product['PRICE'] = $productPrice;
        }

        return $product;
    }

    private function getOffers(int $productId, array $arSelect, array &$fileIds): array
    {
        $offersResult = CCatalogSKU::getOffersList($productId, $this->arParams['IBLOCK_ID'], [], ['IBLOCK_ID']);
        $offers = [];
        if (!empty($offersResult) && !empty(current($offersResult))) {
            $offersIblockIds = array_unique(array_column(current($offersResult), 'IBLOCK_ID'));
            foreach ($offersIblockIds as $item) {
                $properties = [];
                CIBlockElement::GetPropertyValuesArray($properties, $item, []);

                $keys = $this->getPropertyKeys($properties);
                $arSelect = array_merge($arSelect, $keys);

                $currentOffers = CCatalogSKU::getOffersList($productId, $this->arParams['IBLOCK_ID'], [], $arSelect);
                $offers = array_merge($offers, current($currentOffers));

                foreach (current($currentOffers) as $offer) {
                    $fileIds = array_merge($fileIds, $this->getFilesByItem($offer));
                }
            }
        }

        $ids = array_column($offers, 'ID');
        $prices = PriceTable::getList([
            'filter' => ['@PRODUCT_ID' => $ids],
        ])->fetchAll();
        foreach ($offers as &$offer) {
            $price = current(array_filter($prices, function ($item) use ($offer) {
                return (int) $item['PRODUCT_ID'] === $offer['ID'];
            }));

            if ($price) {
                $offer['PRICE'] = $price;
            }
        }

        return $offers;
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
        if (isset($item['PROPERTY_VIDEO_VALUE']) && $item['PROPERTY_VIDEO_VALUE']) {
            $result[] = $item['PROPERTY_VIDEO_VALUE'];
        }

        return $result;
    }

    private function transformData(array $data): array
    {
        $result = [
            'TITLE' => $data['PRODUCT']['NAME'],
            'PRICES' => [],
            'DISCOUNT_LABELS' => [],
            'COLORS' => [],
            'SIZES' => [],
            'ARTICLES' => [],
            'BESTSELLERS' => [],
            'PACKAGINGS' => [],
            'PHOTOS' => [],
            'PRODUCT_IMAGE' => [$data['FILES'][$data['PRODUCT']['DETAIL_PICTURE']]['SRC']],
            'DESCRIPTION' => $data['PRODUCT']['DETAIL_TEXT'],
            'COMPOSITION' => $data['PRODUCT']['PROPERTY_COMPOSITION_VALUE'],
            'BREED' => $data['PRODUCT']['PROPERTY_BREED_VALUE'],
            'AGE' => $data['PRODUCT']['PROPERTY_AGE_VALUE'],
            'MATERIAL' => $data['PRODUCT']['PROPERTY_MATERIAL_VALUE'],
            'PURPOSE' => $data['PRODUCT']['PROPERTY_PURPOSE_VALUE'],
            'APPOINTMENT' => $data['PRODUCT']['PROPERTY_APPOINTMENT_VALUE'],
            'IS_TREAT' => $data['PRODUCT']['PROPERTY_IS_TREAT_VALUE'] === 'Да',
            'BASKET_COUNT' => [],
        ];

        foreach ($data['OFFERS'] as $offer) {
            $result['PRICES'][$offer['ID']] = $offer['PRICE'];
            $result['DISCOUNT_LABELS'][$offer['ID']] = $offer['PRICE']['DISCOUNT_LABEL'];
            $result['COLORS'][$offer['ID']] = $offer['PROPERTY_COLOR_VALUE'];
            $result['SIZES'][$offer['ID']] = $offer['PROPERTY_SIZE_VALUE'];
            $result['ARTICLES'][$offer['ID']] = $offer['PROPERTY_ARTICLE_VALUE'];
            $result['BESTSELLERS'][$offer['ID']] = $offer['PROPERTY_BESTSELLER_VALUE'] === 'Да';
            $result['PACKAGINGS'][$offer['ID']] = $offer['PROPERTY_PACKAGING_VALUE'];
            if (is_array($offer['PROPERTY_IMAGES_VALUE'])) {
                foreach ($offer['PROPERTY_IMAGES_VALUE'] as $item) {
                    $result['PHOTOS'][$offer['ID']][] = $data['FILES'][$item]['SRC'];
                }
            }
            $result['BASKET_COUNT'][$offer['ID']] = $data['BASKET'][$offer['ID']]['QUANTITY'] ?? 0;
        }

        return $result;
    }
}
