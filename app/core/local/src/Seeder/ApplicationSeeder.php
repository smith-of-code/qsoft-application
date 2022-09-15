<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use CUserFieldEnum;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use CUserTypeEntity;
use QSoft\Factory\ApplicationFactory;
use QSoft\Factory\TransactionFactory;
use RuntimeException;
use CUser;

class ApplicationSeeder implements Seederable
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

        $typeEnumIds = [];
        $statusEnumIds = [];
        while ($field = $result->Fetch()) {
            if ($field['FIELD_NAME'] === 'UF_TYPE') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $typeEnumIds = array_column($enums, 'ID');
            } else if ($field['FIELD_NAME'] === 'UF_STATUS') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $statusEnumIds = array_column($enums, 'ID');
            }
        }

        $userIds = [];
        $users = CUser::GetList();
        while ($user = $users->Fetch()) {
            $userIds[] = $user['ID'];
        }

        $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $applications = ApplicationFactory::create()->setCount(rand(2, 5) * count($userIds))->setAdditionalInfo([
            'types' => $typeEnumIds,
            'statuses' => $statusEnumIds,
            'users' => $userIds,
        ])->make();
        array_walk($applications, static function ($application) use ($entityManager) {
            $entityManager::add($application);
        });

        $connection->commitTransaction();
    }
}
