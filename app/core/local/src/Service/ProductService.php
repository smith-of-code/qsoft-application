<?php

namespace QSoft\Service;

use	Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Sale\Internals\BasketTable;
use CCatalogProduct;
use CCatalogSku;
use CFile;
use CIBlockElement;
use Bitrix\Main\ORM\Query\Join;
use QSoft\Entity\User;

class ProductService
{
    private const SELECT_OFFER_PROPERTIES = [
        'COLOR',
        'SIZE',
        'PACKAGING',
    ];

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
        $productIds = [];
        $wishlist = array_flip(array_column($this->user->wishlist->getAll(), 'UF_PRODUCT_ID'));
        while ($offer = $offerIterator->Fetch()) {
            $productId = CCatalogSku::GetProductInfo($offer['ID'])['ID'];
            $productIds[] = $productId;
            $offer['PRODUCT_ID'] = $productId;
            $offer['IN_WISHLIST'] = isset($wishlist[$productId]);
            $offer = array_merge($offer, $this->getOfferFiles($offer));
            $offer = array_merge($offer, $this->getOfferImages($offer));
            $offer = array_merge($offer, $this->getOfferPrices($offer['ID']));
            $offer['BONUSES'] = $this->getOfferBonuses($offer);
            $offer['DISCOUNT_LABELS'] = $this->getOfferDiscountLabels($offer);
            $offer['SELECTS'] = $this->getOfferSelects($offer);
            $offers[$offer['ID']] = $offer;
        }

        $products = CIBlockElement::GetList([], ['ID' => array_keys(array_flip($productIds))]);
        $preparedProducts = [];
        while ($product = $products->GetNext()) {
            $preparedProducts[$product['ID']] = $product;
        }

        foreach ($offers as &$offer) {
            $offer['DETAIL_PAGE_URL'] = $preparedProducts[$offer['PRODUCT_ID']]['DETAIL_PAGE_URL'];
        }

        return $offers;
    }

    private function getOfferPrices(int $offerId): array
    {
        $prices = CCatalogProduct::GetOptimalPrice($offerId);
        if ($this->user->isAuthorized && $this->user->groups->isConsultant()) {
            return [
                'PRICE' => $prices['DISCOUNT_PRICE'],
                'BASE_PRICE' => $prices['PRICE']['PRICE'] !== $prices['DISCOUNT_PRICE']
                    ? $prices['PRICE']['PRICE']
                    : null,
            ];
        }
        return [
            'PRICE' => $prices['DISCOUNT_PRICE'],
        ];
    }

    private function getOfferBonuses(array $offer): int
    {
        if ($this->user->isAuthorized && $this->user->groups->isConsultant()) {
            return $offer["PROPERTY_BONUSES_{$this->user->loyaltyLevel}_VALUE"] ?? 0;
        }
        return 0;
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
        foreach (self::SELECT_OFFER_PROPERTIES as $property) {
            if ($offer["PROPERTY_{$property}_VALUE"]) {
                $result[] = $offer["PROPERTY_{$property}_VALUE"];
            }
        }
        return $result;
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

    /**
     * @return DataManager|string
     */
    public static function getProductOfferDataClass(): string
    {
        self::includeModules();
        $basketProductIdRef = new Reference('BASKET',
            BasketTable::class,
            Join::on('this.ID', 'ref.PRODUCT_ID'));
        $offerProductEntity = IBlock::wakeUp(IBLOCK_PRODUCT_OFFER)
            ->getEntityDataClass()
            ::getEntity();
        $offerProductEntity->addField($basketProductIdRef);
        return $offerProductEntity->getDataClass();
    }


    private static function includeModules(): void
    {
        Loader::includeModule('iblock');
        Loader::includeModule('sale');
    }
}