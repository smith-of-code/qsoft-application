<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use QSoft\Factory\TeamFactory;
use RuntimeException;
use CUser;
use Psr\Log\LogLevel;
use QSoft\Logger\Logger;

class TeamSeeder implements Seederable
{
    public static function seed(?string $blockName = null): void
    {
        if (!Loader::includeModule('highloadblock')) {
            $error = new RuntimeException('Не удалось загрузить модуль highloadblock');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());
 
            throw $error;
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => $blockName]]);
        if (!$hlBlock) {
            $error = new RuntimeException(sprintf('Не найден hl-блок %s', $blockName));
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        $userIds = [];
        $users = CUser::GetList();
        while ($user = $users->Fetch()) {
            $userIds[] = $user['ID'];
        }

        $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $teams = TeamFactory::create()
            ->setCount(ceil(0.5 * count($userIds)))
            ->setAdditionalInfo('users', $userIds)
            ->make();
        array_walk($teams, static function ($team) use ($entityManager) {
            $entityManager::add($team);
        });

        $connection->commitTransaction();
    }
}
