<?php

namespace QSoft\Service;

use Bitrix\Catalog\GroupTable;
use Bitrix\Catalog\PriceTable;
use Bitrix\Sale\Internals\BasketTable;
use CCatalogProduct;
use CCatalogSku;
use CFile;
use CIBlockElement;
use QSoft\Entity\User;
use QSoft\Helper\HLReferencesHelper;

class ProductService
{
    private const FILE_FIELDS = [
        'DETAIL_PICTURE',
        'PREVIEW_PICTURE',
        'PROPERTY_IMAGES_VALUE',
        'PROPERTY_MORE_PHOTO_VALUE',
        'PROPERTY_DOCUMENTS_VALUE',
    ];

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getProduct(int $productId): array
    {
        if (!$productId) {
            return [];
        }

        $productProperties = [];
        CIBlockElement::GetPropertyValuesArray($productProperties, IBLOCK_PRODUCT, ['ID' => $productId]);
        $product = CIBlockElement::GetList([], ['ID' => $productId], false, false, array_merge(
            array_map(static fn ($item) => "PROPERTY_$item", array_keys(current($productProperties))),
            [
                'ID',
                'DETAIL_PAGE_URL',
            ],
        ));

        if (!$product || !$product = $product->GetNext()) {
            return [];
        }

        $offers = CCatalogSKU::getOffersList($productId, IBLOCK_PRODUCT, ['ACTIVE' => 'Y'], ['IBLOCK_ID']);
        $offersIds = array_keys($offers);
        $product['OFFERS'] = $this->getOffersByIds($offersIds);

        return $product;
    }

    public function getOffersByRepeatedIds(array $offerIds): array
    {
        if (!$offerIds) {
            return [];
        }

        $offerIterator = CIBlockElement::GetList([], ['ID' => $offerIds], false, false, ['ID', 'NAME']);

        $offers = [];
        while ($offer = $offerIterator->Fetch()) {
            $offers[$offer['ID']] = $offer;
        }
        return $offers;
    }

    public function getOffersByIds(array $offerIds): array
    {
        if (!$offerIds) {
            return [];
        }

        $properties = [];
        CIBlockElement::GetPropertyValuesArray($properties, IBLOCK_PRODUCT_OFFER, ['ID' => current($offerIds)]);
        $offerIterator = CIBlockElement::GetList([], ['ID' => $offerIds], false, false, array_merge(
            array_map(static fn ($item) => "PROPERTY_$item", array_keys(current($properties))),
            [
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
                'CATALOG_AVAILABLE',
            ],
        ));

        $offers = [];
        $wishlist = array_flip(array_column($this->user->wishlist->getAll(), 'UF_PRODUCT_ID'));
        while ($offer = $offerIterator->Fetch()) {
            $offer['IN_WISHLIST'] = isset($wishlist[$offer['ID']]);
            $offer = array_merge($offer, $this->getOfferFiles($offer));
            $offer = array_merge($offer, $this->getOfferImages($offer));
            $offer = array_merge($offer, $this->getOfferPrices($offer['ID']));
            $offer['BONUSES'] = $this->user->loyalty->calculateBonusesByPrice($offer['PRICE']);
            $offer['DISCOUNT_LABELS'] = $this->getOfferDiscountLabels($offer);
            $offer['SELECTS'] = $this->getOfferSelects($offer);
            $offers[$offer['ID']] = $offer;
        }
        return $offers;
    }

    public function getOfferPrices(int $offerId): array
    {
        $prices = CCatalogProduct::GetOptimalPrice($offerId);
        if ($this->user->isAuthorized && $this->user->groups->isConsultant()) {
            return [
                'PRICE' => $prices['DISCOUNT_PRICE'],
                'BASE_PRICE' => (float)$prices['PRICE']['PRICE'] !== $prices['DISCOUNT_PRICE']
                    ? $prices['PRICE']['PRICE']
                    : null,
            ];
        }
        return ['PRICE' => $prices['DISCOUNT_PRICE']];
    }

    private function getOfferDiscountLabels(array $offer): array
    {
        if (!is_array($offer['PROPERTY_DISCOUNT_LABEL_VALUE'])) {
            $offer['PROPERTY_DISCOUNT_LABEL_VALUE'] = [$offer['PROPERTY_DISCOUNT_LABEL_VALUE']];
        }

        $result = [];
        foreach ($offer['PROPERTY_DISCOUNT_LABEL_VALUE'] as $label) {
            $result[] = $label;
        }
        return $result;
    }

    private function getOfferSelects(array $offer): array
    {
        $result = [];
        foreach ($this->getSelectFields() as $property) {
            if ($value = $offer["PROPERTY_{$property['name']}_VALUE"]) {
                $result[] = $property['values'] ? $property['values'][$value]['name'] : $value;
            }
        }
        return $result;
    }

    private function getSelectFields(): array
    {
        return [
            [
                'name' => 'COLOR',
                'values' => HLReferencesHelper::getColorNames(),
            ],
            [
                'name' => 'SIZE',
                'values' => HLReferencesHelper::getSizeNames(),
            ],
            [
                'name' => 'PACKAGING',
            ],
        ];
    }

    private function getOfferFiles(array $offer): array
    {
        $result = [];
        $fileIds = [];
        foreach (self::FILE_FIELDS as $field) {
            if (isset($offer[$field]) && $offer[$field]) {
                if (is_array($offer[$field])) {
                    foreach ($offer[$field] as $fileId) {
                        $fileIds[$fileId] = $field;
                    }
                } else {
                    $fileIds[$offer[$field]] = $field;
                }
            }
        }
        $files = CFile::GetList([], ['@ID' => implode(',', array_keys($fileIds))]);
        while ($file = $files->Fetch()) {
            if (is_array($offer[$fileIds[$file['ID']]])) {
                $result[$fileIds[$file['ID']] . '_SRC'][] = CFile::GetFileSRC($file);
            } else {
                $result[$fileIds[$file['ID']] . '_SRC'] = CFile::GetFileSRC($file);
            }
        }
        return array_merge($result);
    }

    private function getOfferImages(array $offer): array
    {
        return [
            'DETAIL_IMAGE_SRC' => $offer['DETAIL_PICTURE_SRC']
                ?? (is_array($offer['PROPERTY_IMAGES_VALUE_SRC']) ? $offer['PROPERTY_IMAGES_VALUE_SRC'][0] : null)
                ?? (is_array($offer['PROPERTY_MORE_PHOTO_VALUE_SRC']) ? $offer['PROPERTY_MORE_PHOTO_VALUE_SRC'][0] : null)
                ?? $offer['PREVIEW_PICTURE_SRC'],
            'PREVIEW_IMAGE_SRC' => $offer['PREVIEW_PICTURE_SRC']
                ?? $offer['DETAIL_PICTURE_SRC']
                ?? (is_array($offer['PROPERTY_IMAGES_VALUE_SRC']) ? $offer['PROPERTY_IMAGES_VALUE_SRC'][0] : null)
                ?? (is_array($offer['PROPERTY_MORE_PHOTO_VALUE_SRC']) ? $offer['PROPERTY_MORE_PHOTO_VALUE_SRC'][0] : null),
        ];
    }

    public static function getProductDataFromBasket($orderId, int $offset = 0, int $limit = 0): array
    {
        return BasketTable::getList([
            'filter' => [
                '=ORDER_ID' => $orderId,
            ],
            'select' => [
                'PRODUCT_ID',
                'PRICE',
                'QUANTITY',
            ],
            'offset' => $offset,
            'limit' => $limit,
        ])->fetchAll();
    }

    public static function getProductByIds(array $productsIds): array
    {
        if (empty($productsIds)) {
            return [];
        }

        $offersResult = \CIBlockElement::GetList(
            [],
            [
                'ID' => $productsIds
            ],
            false,
            false,
            [
                'ID',
                'NAME',
                'PROPERTY_ARTICLE',
                'PROPERTY_IMAGES',
            ]
        );
        $offers = [];
        while ($offer = $offersResult->GetNext(true, false)) {
            $offers[$offer['ID']] = $offer;
        }
        return $offers;
    }

    public static function getBonusByProductIds(array $productIds): array
    {
        if (empty($productIds)) {
            return [];
        }

        $levelId = 0;

        $levels = GroupTable::GetList(
            [
                'select' => ['*'],
            ]
        )->fetchAll();

        $user = new User();

        $level = $user->loyalty->getLoyaltyProgramInfo()['CURRENT_LEVEL'];

        foreach ($levels as $lvl) {
            if ($lvl['NAME'] == $level) {
                $levelId = $lvl['ID'];
                break;
            }
        }

        $dbBonuses = PriceTable::GetList(
            [
                'select' => ['*'],
                'filter' => [
                    'PRODUCT_ID' => $productIds,
                    'CATALOG_GROUP_ID' => $levelId,
                ],
            ]
        );

        while ($row = $dbBonuses->Fetch()) {
            $bonuses[$row['PRODUCT_ID']] = $row;
        }

        return $bonuses ?? [];
    }
}