<?php

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\Component\Tools;
use Bitrix\Catalog\PriceTable;
use Bitrix\Iblock\Model\PropertyFeature;
use Bitrix\Iblock\Component\Element;
use QSoft\Helper\HLReferencesHelper;

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

Loc::loadMessages(__FILE__);

if (!Loader::includeModule('iblock'))
{
    ShowError(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
    return;
}

class CatalogElementComponent extends Element
{
    private bool $isError = false;

    /**
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams($arParams): array
    {
        $arParams = parent::onPrepareComponentParams($arParams);

        $arParams['IBLOCK_TYPE'] = 'catalog';

        if (!defined('IBLOCK_PRODUCT')) {
            Tools::process404(Loc::getMessage('IBLOCK_CONSTANT_NOT_SET'), false, false);
            $this->isError = true;

            return $arParams;
        }

        $arParams['IBLOCK_ID'] = IBLOCK_PRODUCT;

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
        $this->checkModules();
        try {
            if ($this->isError) {
                return;
            }

            if (!Loader::includeModule('iblock') || !Loader::includeModule('catalog')) {
                throw new Main\LoaderException(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
            }

            if (!Loader::includeModule('sale') || !Loader::includeModule('catalog')) {
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
                    'SORT',
                    'DETAIL_PAGE_URL',
                    'PREVIEW_PICTURE',
                    'DETAIL_PICTURE',
                    'DETAIL_TEXT',
                    'DETAIL_TEXT_TYPE',
                    'PREVIEW_TEXT',
                    'PREVIEW_TEXT_TYPE',
                ];

                $fileIds = [];
                $product = $this->getProduct($baseSelect);
                $this->arResult['PRODUCT'] = $product;

                $fileIds = $this->getFilesByItem($product);
                $offers = $this->getOffers($product['ID'], $baseSelect, $fileIds); // TODO filesids
                $this->arResult['OFFERS'] = $offers;

                $sectionDocuments = $this->getSectionFiles($product['IBLOCK_SECTION_ID'], $fileIds);
                $this->arResult['DOCUMENTS'] = array_merge($sectionDocuments, $product['PROPERTY_DOCUMENTS_VALUE'] ?? []);

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
        $filter = [
            'ACTIVE' => 'Y'
        ];

        $offersResult = CCatalogSKU::getOffersList($productId, $this->arParams['IBLOCK_ID'], $filter , ['IBLOCK_ID']);
        $offers = [];
        if (!empty($offersResult) && !empty(current($offersResult))) {
            $offersIblockIds = array_unique(array_column(current($offersResult), 'IBLOCK_ID'));
            foreach ($offersIblockIds as $item) {
                $properties = [];
                CIBlockElement::GetPropertyValuesArray($properties, $item, []);

                $keys = $this->getPropertyKeys($properties);
                $arSelect = array_merge($arSelect, $keys);

                $currentOffers = CCatalogSKU::getOffersList($productId, $this->arParams['IBLOCK_ID'], $filter, array_merge($arSelect, ['CATALOG_AVAILABLE']));
                $offers = array_merge($offers, current($currentOffers));
                foreach (current($currentOffers) as $offer) {
                    $fileIds = array_merge($fileIds, $this->getFilesByItem($offer));
                }
            }
        }

        usort($offers, function ($a, $b) {
            if ($a['CATALOG_AVAILABLE'] == $b['CATALOG_AVAILABLE']) {
                return  $a['SORT'] > $b['SORT'];
            } else if ($a['CATALOG_AVAILABLE'] == 'Y') {
                return false;
            } else {
                return true;
            }

        });

        if ($ids = array_column($offers, 'ID')) {
            $prices = PriceTable::getList([
                'filter' => ['=PRODUCT_ID' => $ids],
            ])->fetchAll();
            foreach ($offers as &$offer) {
                // TODO получение баллов
                $price = current(array_filter($prices, function ($item) use ($offer) {
                    return (int) $item['PRODUCT_ID'] === $offer['ID'];
                }));

                if ($price) {
                    $offer['PRICE'] = $price;
                }
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
        if (isset($item['PROPERTY_IMAGES_VALUE']) && count($item['PROPERTY_IMAGES_VALUE']) > 0) {
            $result = array_merge($item['PROPERTY_IMAGES_VALUE'], $result);
        }
        if (isset($item['PROPERTY_DOCUMENTS_VALUE']) && $item['PROPERTY_DOCUMENTS_VALUE']) {
            $result = array_merge($item['PROPERTY_DOCUMENTS_VALUE'], $result);
        }

        return $result;
    }

    private function getSectionFiles($sectionId, &$fileIds, $finalDocuments = []): array
    {
        if (!$sectionId) {
            return $finalDocuments;
        }

        global $USER_FIELD_MANAGER;
        $documents = $USER_FIELD_MANAGER->GetUserFieldValue(
            'IBLOCK_' . $this->arParams['IBLOCK_ID'] . '_SECTION',
            'UF_DOCUMENTS',
            $sectionId,
            LANGUAGE_ID
        );

        $section = CIBlockSection::GetByID($sectionId)->Fetch();
        $sectionId = $section['IBLOCK_SECTION_ID'];

        if ($documents) {
            $fileIds = array_merge($fileIds, $documents);
            $finalDocuments = array_merge($finalDocuments, $documents);
        }

        return $this->getSectionFiles($sectionId, $fileIds, $finalDocuments);
    }

    private function transformData(array $data): array
    {
        $result = [
            'ID' => $data['PRODUCT']['ID'],
            'CODE' => $data['PRODUCT']['CODE'],
            'TITLE' => $data['PRODUCT']['NAME'],
            'PRICES' => [],
            'DISCOUNT_LABELS' => [],
            'COLORS' => [],
            'SIZES' => [],
            'ARTICLES' => [],
            'BESTSELLERS' => [],
            'PACKAGINGS' => [],
            'PHOTOS' => [],
            'PRODUCT_VIDEO' => $data['PRODUCT']['PROPERTY_VIDEO_VALUE'],
            'PRODUCT_IMAGE' => $data['FILES'][$data['PRODUCT']['DETAIL_PICTURE']],
            'DESCRIPTION' => $data['PRODUCT']['DETAIL_TEXT'],
            'COMPOSITION' => $data['PRODUCT']['PROPERTY_COMPOSITION_VALUE'],
            'BREED' => $data['PRODUCT']['PROPERTY_BREED_VALUE'],
            'AGE' => $data['PRODUCT']['PROPERTY_AGE_VALUE'],
            'MATERIAL' => $data['PRODUCT']['PROPERTY_MATERIAL_VALUE'],
            'PURPOSE' => $data['PRODUCT']['PROPERTY_PURPOSE_VALUE'],
            'APPOINTMENT' => $data['PRODUCT']['PROPERTY_APPOINTMENT_VALUE'],
            'IS_TREAT' => $data['PRODUCT']['PROPERTY_TREAT_VALUE'] === 'Да',
            'FEEDING_RECOMMENDATIONS' => $data['PRODUCT']['PROPERTY_FEEDING_RECOMMENDATIONS_VALUE'],
            'PRODUCT_DETAILS' => $data['PRODUCT']['PROPERTY_PRODUCT_DETAILS_VALUE'],
            'BASKET_COUNT' => [],
            'DOCUMENTS' => [],
            'COLOR_NAMES' => HLReferencesHelper::getColorNames(),
            'SIZE_NAMES' => HLReferencesHelper::getSizeNames(),
            'OFFERS' => $data['OFFERS'], // TODO format
            'OFFER_FIRST' => array_first ($data['OFFERS']) ['ID'],
        ];

        foreach ($data['OFFERS'] as $offer) {
            $result['SORT'][] = $offer['ID'];
            $result['PRICES'][$offer['ID']] = $offer['PRICE'];

            $result['DISCOUNT_LABELS'][$offer['ID']]['NAME'] = $offer['PROPERTY_DISCOUNT_LABEL_VALUE'];
            $result['DISCOUNT_LABELS'][$offer['ID']]['COLOR'] = $this->getDiscountLabelColor($offer['PROPERTY_DISCOUNT_LABEL_VALUE']);

            if ($offer['PROPERTY_COLOR_VALUE'] && $offer['PROPERTY_SIZE_VALUE']) {
                $result['SIZES'][$offer['ID']] = $offer['PROPERTY_SIZE_VALUE'];
                $result['SIZE2COLOR'][$offer['PROPERTY_SIZE_VALUE']][$offer['PROPERTY_COLOR_VALUE']][] = $offer['ID'];
                $result['COLORS'][ $offer['ID']] = $offer['PROPERTY_COLOR_VALUE'];
                $result['COLOR2SIZE'][$offer['PROPERTY_COLOR_VALUE']][$offer['PROPERTY_SIZE_VALUE']][] = $offer['ID'] ;
            }

            $result['ARTICLES'][$offer['ID']] = $offer['PROPERTY_ARTICLE_VALUE'];
            $result['BESTSELLERS'][$offer['ID']] = $offer['PROPERTY_IS_BESTSELLER_VALUE'] === 'Да';

            if($offer['PROPERTY_PACKAGING_VALUE']) {
                $result['PACKAGINGS'][] = [
                    'offerId' => $offer['ID'],
                    'package'=> $offer['PROPERTY_PACKAGING_VALUE']
                ];
            }
            
            if (is_array($offer['PROPERTY_IMAGES_VALUE'])) {
                foreach ($offer['PROPERTY_IMAGES_VALUE'] as $item) {
                    $result['PHOTOS'][$offer['ID']][] = $data['FILES'][$item];
                }
            }
            $result['BASKET_COUNT'][$offer['ID']] = $data['BASKET'][$offer['ID']]['QUANTITY'] ?? 0;
            $result['AVAILABLE'][$offer['ID']] = $offer['CATALOG_AVAILABLE'] == 'Y';
        }

        foreach ($data['DOCUMENTS'] as $documentId) {
            $result['DOCUMENTS'][] = $data['FILES'][(string) $documentId];
        }

        // Объект CIBlockPropertyResult
        $propsResult = $this->getProperties();

        // id элементов, у которых выставлен параметр "Показывать на детальной странице.
        $showedPropertiesInDetail = $this->getShowedInDetailPageProperties();

        while($item = $propsResult->GetNext()) {
            $result['PROPERTY_NAMES'][$item['CODE']] = $item['NAME'];

            if (in_array($item['ID'], $showedPropertiesInDetail)) {
                $properties[$item['ID']] = $item;
            }
        }

        $index = 1;
        foreach ($properties as $property) {
            if ($index++ > $this->arParams['PROPERTY_COUNT_DETAIL']) {
                break;
            }

            $code = $property['CODE'];
            if ($value = $data['PRODUCT']["PROPERTY_{$code}_VALUE"]) {
                $result['SPECIFICATION'][$code] = $value;
            }
        }

        $result['ENERGY_VALUE'] = [
            'CALCIUM' => $data['PRODUCT']['PROPERTY_CALCIUM_VALUE'],
            'PRHOSPHORUS' => $data['PRODUCT']['PROPERTY_PRHOSPHORUS_VALUE'],
            'ROW_ASH' => $data['PRODUCT']['PROPERTY_ROW_ASH_VALUE'],
            'ENERGY' => $data['PRODUCT']['PROPERTY_ENERGY_VALUE'],
            'PROTEIN' => $data['PRODUCT']['PROPERTY_PROTEIN_VALUE'],
            'CRUDE_FIBRE' => $data['PRODUCT']['PROPERTY_CRUDE_FIBRE_VALUE'],
        ];

        $result['ENERGY_VALUE'] = array_filter($result['ENERGY_VALUE'], fn ($value) => !empty($value));

        return $result;
    }

    /**
     * @return CIBlockPropertyResult
     */
    private function getProperties():CIBlockPropertyResult
    {
        return CIBlockProperty::GetList(
            ["SORT" => "ASC"],
            [
                "ACTIVE"    => "Y",
                "IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
            ]
        );
    }   

    /**
     * @return array|null
     */
    private function getShowedInDetailPageProperties(): ?array
    {
        return PropertyFeature::getDetailPageShowPropertyCodes(
            $this->arParams['IBLOCK_ID'],
            ['DETAIL_PAGE_SHOW' => 'Y']
        );
    }


    /**
     * @return array|null
     */
    private function getOfferDetailPageProperties(): ?array //  TODO проверку добавить
    {
        $detailShowOfferProps = PropertyFeature::getDetailPageShowPropertyCodes(
            IBLOCK_PRODUCT_OFFER
        );
        $props = \Bitrix\Iblock\PropertyTable::getList([
            'filter' => [
                'id' => $detailShowOfferProps,
            ],
            'select' => ['ID', 'CODE']
        ]);

        $result = [];
        while ($item = $props->fetch()) {
            $result[$item['ID']] = $item['CODE'];
        }
        return $result;
    }

    private function getDiscountLabelColor($typeName) {
        $color = [
            'Сезонное предложение' => 'violet',
            'Ограниченное предложение' => 'pink'
        ];

        return $color[$typeName] ?? 'violet';
    }
}

