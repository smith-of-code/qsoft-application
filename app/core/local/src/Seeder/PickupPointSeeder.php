<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use Bitrix\Main\Security\Random;
use CUserFieldEnum;
use CUserTypeEntity;
use QSoft\Factory\PickupPointFactory;
use RuntimeException;


class PickupPointSeeder implements Seederable
{
    public static function seed(string $blockName): void
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new RuntimeException('Не удалось загрузить модуль highloadblock');
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => $blockName]]);
        if (!$hlBlock) {
            throw new RuntimeException(sprintf('Не найден hl-блок %s', $blockName));
        }

        $result = CUserTypeEntity::GetList([], ['ENTITY_ID' => "HLBLOCK_{$hlBlock['ID']}"]);

        $cityIds = [];
        while ($field = $result->Fetch()) {
            if ($field['FIELD_NAME'] === 'UF_CITY') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $cityIds = array_column($enums, 'ID');
            }
        }

        $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $pickupPoints = PickupPointFactory::create()
            ->setCount(Random::getInt(10, 20))
            ->setAdditionalInfo('cities', $cityIds)
            ->make();
        array_walk($pickupPoints, static function ($pickupPoint) use ($entityManager) {
            $entityManager::add($pickupPoint);
        });

        $connection->commitTransaction();
    }
}
