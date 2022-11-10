<?php

namespace QSoft\Helper;

use QSoft\ORM\PickupPointTable;

class PickupPointHelper
{
    public function getPickupPoints(): array
    {
        $pickupPoints = PickupPointTable::getList([
            'order' => ['UF_NAME' => 'ASC'],
            'select' => ['ID', 'UF_CITY', 'UF_NAME'],
        ])->fetchAll();

        $result = [];
        foreach ($pickupPoints as $pickupPoint) {
            $result[$pickupPoint['UF_CITY']][$pickupPoint['ID']] = ['name' => $pickupPoint['UF_NAME']];
        }
        return $result;
    }

    public function getCities(): array
    {
        return HlBlockHelper::getPreparedEnumFieldValues(PickupPointTable::getTableName(), 'UF_CITY');
    }
}