<?php

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main;
use Bitrix\Main\Data\Cache;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\Component\Tools;
use Bitrix\Catalog\PriceTable;
use Bitrix\Iblock\Model\PropertyFeature;
use Bitrix\Iblock\Component\Element;
use QSoft\Entity\User;
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
    private const CACHE_TTL = 3600;

    private bool $isError = false;

    private User $user;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;
    }

    /**
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams($arParams): array
    {
        $arParams = parent::onPrepareComponentParams($arParams);

        $arParams['HIDE_NOT_AVAILABLE'] = 'Y';
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
            if ($this->isError)  return;

            if (!Loader::includeModule('iblock') || !Loader::includeModule('catalog')) {
                throw new Main\LoaderException(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
            }

            if (!Loader::includeModule('sale') || !Loader::includeModule('catalog')) {
                throw new Main\LoaderException(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
            }

            $cache = Cache::createInstance();
            $loyaltyLevel = $this->user->isAuthorized ? $this->user->loyaltyLevel : 0;
            if ($cache->initCache(self::CACHE_TTL, "product-detail-{$this->arParams['ELEMENT_CODE']}-$loyaltyLevel")) {
                $this->arResult = $cache->getVars();

                $wishlist = array_flip(array_column($this->user->wishlist->getAll(), 'UF_PRODUCT_ID'));
                foreach ($this->arResult['OFFERS'] as &$offer) {
                    $offer['IN_WISHLIST'] = isset($wishlist[$offer['ID']]);
                }
            } elseif ($cache->startDataCache()) {
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

                $product = $this->getProduct($baseSelect);
                $this->arResult['PRODUCT'] = $product;

                $fileIds = $this->getFilesByItem($product);
                $offers = $this->getOffers($product['ID'], $fileIds); // TODO filesids
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

                $this->arResult = $this->transformData($this->arResult);
                $cache->endDataCache($this->arResult);
            }

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

    private function getOffers(int $productId, array &$fileIds): array
    {
        $offersResult = CCatalogSKU::getOffersList($productId, $this->arParams['IBLOCK_ID'], ['ACTIVE' => 'Y'], ['IBLOCK_ID']);
        $offers = $this->user->products->getOffersByIds(array_keys($offersResult[$productId]));
        foreach ($offers as $offer) {
            $fileIds = array_merge($fileIds, $this->getFilesByItem($offer));
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
        $colors = HLReferencesHelper::getColorNames();
        $result = [
            'IS_CONSULTANT' => $this->user->isAuthorized && $this->user->groups->isConsultant(),
            'ID' => $data['PRODUCT']['ID'],
            'IBLOCK_ID' => $data['PRODUCT']['IBLOCK_ID'],
            'SECTION_ID' => $data['PRODUCT']['IBLOCK_SECTION_ID'],
            'CODE' => $data['PRODUCT']['CODE'],
            'TITLE' => $data['PRODUCT']['NAME'],
            'PRICES' => [],
            'BONUSES_PRICES' => [],
            'DISCOUNT_LABELS' => [],
            'COLORS' => [],
            'SIZES' => [],
            'ARTICLES' => [],
            'BESTSELLERS' => [],
            'PACKAGINGS' => [],
            'PHOTOS' => [],
            'NONRETURNABLE' => (bool)$data['PRODUCT']['PROPERTY_NONRETURNABLE_PRODUCT_VALUE'],
            'PRODUCT_VIDEO' => $data['PRODUCT']['PROPERTY_VIDEO_VALUE'],
            'PRODUCT_IMAGE' => $data['FILES'][$data['PRODUCT']['DETAIL_PICTURE']],
            'DESCRIPTION' => $data['PRODUCT']['DETAIL_TEXT'],
            'PRODUCT_FEATURES' => $data['PRODUCT']['PROPERTY_PRODUCT_FEATURES_VALUE'] ? $data['PRODUCT']['PROPERTY_PRODUCT_FEATURES_VALUE']['TEXT'] : null,
            'COMPOSITION' => $data['PRODUCT']['PROPERTY_COMPOSITION_VALUE'],
            'BREED' => $data['PRODUCT']['PROPERTY_BREED_VALUE'],
            'AGE' => $data['PRODUCT']['PROPERTY_AGE_VALUE'],
            'MATERIAL' => $data['PRODUCT']['PROPERTY_MATERIAL_VALUE'],
            'PURPOSE' => $data['PRODUCT']['PROPERTY_PURPOSE_VALUE'],
            'APPOINTMENT' => $data['PRODUCT']['PROPERTY_APPOINTMENT_VALUE'],
            'FEEDING_RECOMMENDATIONS' => $data['PRODUCT']['PROPERTY_FEEDING_RECOMMENDATIONS_VALUE'],
            'PRODUCT_DETAILS' => $data['PRODUCT']['PROPERTY_PRODUCT_DETAILS_VALUE'],
            'BASKET_COUNT' => [],
            'DOCUMENTS' => [],
            'COLOR_NAMES' => array_map(static fn (array $color) => $color['name'], $colors),
            'ALL_COLORS' => $colors,
            'SIZE_NAMES' => array_map(static fn (array $size) => $size['name'], HLReferencesHelper::getSizeNames()),
            'OFFERS' => $data['OFFERS'], // TODO format
            'OFFER_FIRST' => array_first(array_filter($data['OFFERS'],fn($offer)=>$offer['CATALOG_AVAILABLE']==='Y'))['ID'],
            'RELATED_PRODUCTS' => $this->getRelatedProductsIds($data['PRODUCT']['ID']),
        ];

        if (!$result['OFFER_FIRST']) {
            LocalRedirect('/404/');
        }

        foreach ($data['OFFERS'] as $offer) {
            $result['SORT'][] = $offer['ID'];
            $result['PRICES'][$offer['ID']] = [
                'PRICE' => $offer['PRICE'],
                'BASE_PRICE' => $offer['BASE_PRICE'],
            ];
            if ($this->user->isAuthorized && $this->user->groups->isConsultant()) {
                $result['BONUSES_PRICES'][$offer['ID']] = $offer['BONUSES'];
            }

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

        $index = 0;
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
            'PROTEIN' => $data['PRODUCT']['PROPERTY_PROTEIN_VALUE'],
            'ENERGY' => $data['PRODUCT']['PROPERTY_ENERGY_VALUE'],
            'CRUDE_FIBRE' => $data['PRODUCT']['PROPERTY_CRUDE_FIBRE_VALUE'],
            'CALCIUM' => $data['PRODUCT']['PROPERTY_CALCIUM_VALUE'],
            'PRHOSPHORUS' => $data['PRODUCT']['PROPERTY_PRHOSPHORUS_VALUE'],
            'ROW_ASH' => $data['PRODUCT']['PROPERTY_ROW_ASH_VALUE'],
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

    private function getRelatedProductsIds($id) {
        if (! CModule::IncludeModule('iblock')) {
            throw new \Exception('Модуль iblock не найден');
        }
        if (! CModule::IncludeModule('highloadblock')) {
            throw new \Exception('Модуль highloadblock не найден');
        }

        $hlblock = HighloadBlockTable::getList([
            'filter' => ['=NAME' => 'HlRelatedProduct']
        ])->fetch();

        if(! $hlblock){
            throw new \Exception('HL-блок сопутствующих товаров не найден');
        }

        $hlClassName = (HighloadBlockTable::compileEntity($hlblock))->getDataClass();

        $res = $hlClassName::getList([
            'filter' => ['=UF_MAIN_PRODUCT_ID' => $id],
        ])->fetch();

        if ($res) {
            return $res['UF_RELATED_PRODUCT_ID'];
        }

        return [];
    }
}

