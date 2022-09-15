<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
use CUserFieldEnum;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use DateInterval;
use CUserTypeEntity;
use QSoft\Factory\PetFactory;
use RuntimeException;

class PetSeeder implements Seederable
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

        $genderEnumIds = [];
        $kindEnumIds = [];
        $breedEnumIds = [];
        while ($field = $result->Fetch()) {
            if ($field['FIELD_NAME'] === 'UF_GENDER') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $genderEnumIds = array_column($enums, 'ID');
            } else if ($field['FIELD_NAME'] === 'UF_KIND') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $kindEnumIds = array_column($enums, 'ID');
            } else if ($field['FIELD_NAME'] === 'UF_BREED') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $breedEnumIds = array_column($enums, 'ID');
            }
        }

        $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $pets = PetFactory::create()->setCount(rand(5, 15))->setAdditionalInfo([
            'genders' => $genderEnumIds,
            'kinds' => $kindEnumIds,
            'breeds' => $breedEnumIds,
        ])->make();
        array_walk($pets, static function ($pet) use ($entityManager) {
            $entityManager::add($pet);
        });

        $connection->commitTransaction();
    }
}
