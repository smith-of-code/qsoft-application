<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use QSoft\Factory\GroupPropertyFactory;
use QSoft\Factory\TeamFactory;
use RuntimeException;
use CGroup;

class GroupPropertySeeder implements Seederable
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

        $groupIds = [];
        $groups = CGroup::GetList();
        while ($group = $groups->Fetch()) {
            $groupIds[] = $group['ID'];
        }

        $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $groups = GroupPropertyFactory::create()
            ->setCount(ceil(0.5 * count($groupIds)))
            ->setAdditionalInfo('groups', $groupIds)
            ->make();
        array_walk($groups, static function ($group) use ($entityManager) {
            $entityManager::add($group);
        });

        $connection->commitTransaction();
    }
}
