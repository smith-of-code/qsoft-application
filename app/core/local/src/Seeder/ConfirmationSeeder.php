<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use CUserFieldEnum;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use CUserTypeEntity;
use QSoft\Factory\ConfirmationFactory;
use RuntimeException;
use CUser;

class ConfirmationSeeder implements Seederable
{
    public static function seed(?string $blockName = null): void
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
        $channelEnumIds = [];
        while ($field = $result->Fetch()) {
            if ($field['FIELD_NAME'] === 'UF_TYPE') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $typeEnumIds = array_column($enums, 'ID');
            } else if ($field['FIELD_NAME'] === 'UF_CHANNEL') {
                $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $channelEnumIds = array_column($enums, 'ID');
            }
        }

        $userIds = [];
        $users = CUser::GetList();
        while ($user = $users->Fetch()) {
            $userIds[] = $user['ID'];
        }

        $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $confirmations = ConfirmationFactory::create()->setCount(rand(2, 5) * count($userIds))->setAdditionalInfo([
            'types' => $typeEnumIds,
            'channels' => $channelEnumIds,
            'users' => $userIds,
        ])->make();
        array_walk($confirmations, static function ($confirmation) use ($entityManager) {
            $entityManager::add($confirmation);
        });

        $connection->commitTransaction();
    }
}
