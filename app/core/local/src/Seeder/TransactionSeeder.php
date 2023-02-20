<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use CUserFieldEnum;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use CUserTypeEntity;
use QSoft\Factory\TransactionFactory;
use RuntimeException;
use CUser;
use Psr\Log\LogLevel;
use QSoft\Logger\Logger;

class TransactionSeeder implements Seederable
{
    public static function seed(?string $blockName = null): void
    {
        if (!Loader::includeModule('highloadblock')) {
            $error = new RuntimeException('Не удалось загрузить модуль highloadblock');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);
 
            throw $error;
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => $blockName]]);
        if (!$hlBlock) {
            $error = new RuntimeException(sprintf('Не найден hl-блок %s', $blockName));
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);
 
            throw $error;
        }

        $result = CUserTypeEntity::GetList([], ['ENTITY_ID' => "HLBLOCK_{$hlBlock['ID']}"]);

        $typeEnumIds = [];
        $sourceEnumIds = [];
        $measureEnumIds = [];
        while ($field = $result->Fetch()) {
            if ($field['FIELD_NAME'] === 'UF_TYPE') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $typeEnumIds = array_column($enums, 'ID');
            } else if ($field['FIELD_NAME'] === 'UF_SOURCE') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $sourceEnumIds = array_column($enums, 'ID');
            } else if ($field['FIELD_NAME'] === 'UF_MEASURE') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $measureEnumIds = array_column($enums, 'ID');
            }
        }

        $userIds = [];
        $users = CUser::GetList();
        while ($user = $users->Fetch()) {
            $userIds[] = $user['ID'];
        }

        $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $transactions = TransactionFactory::create()->setCount(rand(2, 5) * count($userIds))->setAdditionalInfo([
            'types' => $typeEnumIds,
            'sources' => $sourceEnumIds,
            'measures' => $measureEnumIds,
            'users' => $userIds,
        ])->make();
        array_walk($transactions, static function ($transaction) use ($entityManager) {
            $entityManager::add($transaction);
        });

        $connection->commitTransaction();
    }
}
