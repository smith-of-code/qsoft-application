<?php

namespace QSoft\Helper;

use Bitrix\Sale\BasketBase;

class BasketHelper
{

    public static function getOfferProperties(BasketBase $basket, array $properties = []): array
    {
        $offersIds = [];
        foreach ($basket as $basketItem) {
            $offersIds[] = $basketItem->getProductId();
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
                'ID' => $offersIds
            ],
            false,
            false,
            $select
        );

        $result = [];
        while ($item = $dbResult->Fetch()) {
            if (!empty($properties)) {
                foreach ($properties as $prop) {
                    $result[$item['ID']][$prop] = $item['PROPERTY_' . $prop . '_VALUE'];
                }
            } else {
                $result[$item['ID']] = $item;
            }
        }
        return $result;
    }


}