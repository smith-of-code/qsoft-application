<?php

namespace QSoft\Helper;

use Bitrix\Sale\BasketBase;
use Bitrix\Sale\BasketItem;

class BasketHelper
{

    public static function getOfferProperties(BasketBase $basket, array $properties = []): array
    {
        $basketItemsByOffers = [];
        foreach ($basket as $basketItem) {
            /** @var BasketItem $basketItem */
            $basketItemsByOffers[$basketItem->getProductId()] = $basketItem->getId();
        }

        $select = ['ID'];

        if (!empty($properties)) {
            foreach ($properties as $prop) {
                $select[] = 'PROPERTY_' . $prop;
            }
        } else {
            $select[] = 'PROPERTY_*';
        }

        $dbResult = \CIBlockElement::GetList(
            ['SORT' => 'ASC'],
            [
                'IBLOCK_ID' => IBLOCK_PRODUCT_OFFER,
                'ID' => array_keys($basketItemsByOffers)
            ],
            false,
            false,
            $select
        );

        $result = [];
        while ($item = $dbResult->Fetch()) {
            $basketItemId = $basketItemsByOffers[$item['ID']];

            $result[$basketItemId]['BASKET_ITEM_ID'] = $basketItemId;

            if (!empty($properties)) {
                $result[$basketItemId]['ID'] = $item['ID'];

                foreach ($properties as $prop) {
                    $result[$basketItemId][$prop] = $item['PROPERTY_' . $prop . '_VALUE'];
                }
            } else {
                $result[$basketItemId] = array_merge($result[$basketItemId], $item);
            }
        }
        return $result;
    }


}