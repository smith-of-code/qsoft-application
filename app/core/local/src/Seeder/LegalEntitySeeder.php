<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use CUserFieldEnum;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use CUserTypeEntity;
use QSoft\Factory\LegalEntityFactory;
use RuntimeException;
use CUser;

class LegalEntitySeeder implements Seederable
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

        $userIds = [];
        $users = CUser::GetList();
        while ($user = $users->Fetch()) {
            $userIds[] = $user['ID'];
        }

        $statuses = [];
        while ($field = $result->Fetch()) {
            if ($field['FIELD_NAME'] === 'UF_STATUS') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $statuses = array_column($enums, 'ID');
            }
        }

        $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $legalEntities = LegalEntityFactory::create()
            ->setCount(round(0.5 * count($userIds)))
            ->setAdditionalInfo('statuses', $statuses)
            ->setAdditionalInfo('users', $userIds)
            ->make();

        array_walk($legalEntities, static function ($item) use ($entityManager) {
            $entityManager::add($item);
        });

        $connection->commitTransaction();
    }
}
