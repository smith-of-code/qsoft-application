<?php

use Bitrix\Main;
use	Bitrix\Main\Loader;
use	Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\Component\Tools;
use Bitrix\Highloadblock\HighloadBlockTable;
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

            if (
                !Loader::includeModule('iblock')
                || !Loader::includeModule('catalog')
                || !Loader::includeModule('highloadblock')
            ) {
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

                $product = CIBlockElement::GetList([], $arFilter, false, false, ['ID'])->Fetch();
                if (!$product) {
                    Tools::process404(Loc::getMessage('ELEMENT_NOT_FOUND'));
                    return;
                }

                $this->arResult['PRODUCT'] = $product;
                $fileIds = $this->getFilesByItem($product);

                $relatedProducts = $this->getRelatedProducts($product['ID'], $arSelect, $fileIds);
                $this->arResult['RELATED_PRODUCTS'] = $relatedProducts;

                $productIds = array_column($relatedProducts, 'ID');
                $this->arResult['OFFERS'] = $this->getOffers($productIds, $arSelect, $fileIds);

                $itemFilter = ['@ID' => implode(',', array_unique($fileIds))];
                $fileIterator = CFile::GetList([], $itemFilter);
                while ($file = $fileIterator->Fetch()) {
                    $file['SRC'] = CFile::GetFileSRC($file);
                    $this->arResult['FILES'][$file['ID']] = $file;
                }

                $this->setResultCacheKeys([]);
            }

            $basketFilter = [
                'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                'LID' => SITE_ID,
            ];
            $basketIterator = CSaleBasket::GetList([], $basketFilter, false, false, ['*']);

            $basketInfo = [];
            $productIds = $this->getArrayIds($this->arResult['OFFERS']);
            while($basket = $basketIterator->Fetch()) {
                if (in_array($basket['PRODUCT_ID'], $productIds)) {
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

    private function getRelatedProducts(int $productId, array $select, array &$fileIds): array
    {
        $hlBlock = HighloadBlockTable::getList([
            'filter' => ['=TABLE_NAME' => 'related_product'],
        ])->fetch();
        if (!$hlBlock) {
            throw new RuntimeException(Loc::getMessage('HL_BLOCK_NOT_FOUND'));
        }
        $relatedProductTable = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $relatedProducts = $relatedProductTable::getList([
            'select' => ['UF_RELATED_PRODUCT_ID', 'UF_MAIN_PRODUCT_ID'],
            'filter' => [
                'LOGIC' => 'OR',
                ['=UF_MAIN_PRODUCT_ID' => $productId],
                ['=UF_RELATED_PRODUCT_ID' => $productId],
            ],
        ])->fetchAll();
        $relatedProductIds = array_filter(array_unique(array_merge(
            array_column($relatedProducts, 'UF_RELATED_PRODUCT_ID'),
            array_column($relatedProducts, 'UF_MAIN_PRODUCT_ID')
        )), static function ($item) use ($productId) {
            return $item !== $productId;
        });

        $relatedProductDetails = [];
        if (!empty($relatedProductIds)) {
            $relatedProductIterator = CIBlockElement::GetList([], [
                'IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
                'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                'ACTIVE' => 'Y',
                '@ID' => implode(',', $relatedProductIds),
            ], false, false, $select);

            while ($relatedProduct = $relatedProductIterator->Fetch()) {
                $fileIds = array_merge($fileIds, $this->getFilesByItem($relatedProduct));

                $relatedProductDetails[] = $relatedProduct;
            }
        }

        return $relatedProductDetails;
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

        return $result;
    }

    private function getOffers(array $productIds, array $select, array &$fileIds): array
    {
        $offersResult = CCatalogSKU::getOffersList($productIds, $this->arParams['IBLOCK_ID'], [], ['IBLOCK_ID']);
        $offers = [];
        if (!empty($offersResult) && !empty(current($offersResult))) {
            $offersIblockIds = array_unique(array_column(current($offersResult), 'IBLOCK_ID'));
            foreach ($offersIblockIds as $item) {
                $properties = [];
                CIBlockElement::GetPropertyValuesArray($properties, $item, []);

                $keys = $this->getPropertyKeys($properties);
                $arSelect = array_merge($select, $keys);

                $currentOffers = CCatalogSKU::getOffersList($productIds, $this->arParams['IBLOCK_ID'], [], $arSelect);
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
        unset($offer);

        $totalOffers = [];
        foreach ($offers as $offer) {
            $totalOffers[$offer['PARENT_ID']][] = $offer;
        }

        return $totalOffers;
    }

    private function getArrayIds(array $items): array
    {
        $ids = [];
        foreach ($items as $item) {
            $ids = array_merge($ids, array_column($item, 'ID'));
        }

        return $ids;
    }

    private function transformData(array $data): array
    {
        $result = [];
        foreach ($data['RELATED_PRODUCTS'] as $item) {
            $newData = [
                'ID' => $item['ID'],
                'NAME' => $item['NAME'],
                'IMAGE' => $data['FILES'][$data['PRODUCT']['DETAIL_PICTURE']]['SRC'],
                'PRICE' => $data['PRICE'],
                'ARTICLES' => [],
                'BASKET_COUNT' => [],
                'PRICES' => [],
                'DISCOUNT_LABELS' => [],
                'COLORS' => [],
                'SIZES' => [],
                'BESTSELLERS' => [],
                'PACKAGINGS' => [],
            ];

            foreach ($data['OFFERS'][$item['ID']] ?? [] as $offer) {
                $newData['PRICES'][$offer['ID']] = $offer['PRICE'];
                $newData['DISCOUNT_LABELS'][$offer['ID']] = $offer['PRICE']['DISCOUNT_LABEL'];
                $newData['COLORS'][$offer['ID']] = $offer['PROPERTY_COLOR_VALUE'];
                $newData['SIZES'][$offer['ID']] = $offer['PROPERTY_SIZE_VALUE'];
                $newData['ARTICLES'][$offer['ID']] = $offer['PROPERTY_ARTICLE_VALUE'];
                $newData['BESTSELLERS'][$offer['ID']] = $offer['PROPERTY_BESTSELLER_VALUE'] === 'Да';
                $newData['PACKAGINGS'][$offer['ID']] = $offer['PROPERTY_PACKAGING_VALUE'];
                if (is_array($offer['PROPERTY_IMAGES_VALUE'])) {
                    foreach ($offer['PROPERTY_IMAGES_VALUE'] as $item) {
                        $newData['PHOTOS'][$offer['ID']][] = $data['FILES'][$item]['SRC'];
                    }
                }
                $newData['BASKET_COUNT'][$offer['ID']] = $data['BASKET'][$offer['ID']]['QUANTITY'] ?? 0;
            }

            $result[] = $newData;
        }

        return $result;
    }
}
