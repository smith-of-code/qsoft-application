<?php

namespace QSoft\Service;

use Bitrix\Main\GroupTable;
use Bitrix\Main\UserGroupTable;

class UserGroupsService
{
    public const CONSULTANT_GROUP = 'consultant';
    public const BUYER_GROUP = 'buyer';
    const CACHE_TTL = 86400;


    public static function getUserGroups()
    {
        $userGroups = array_pluck(GroupTable::getList(array(
            'filter' => ['!STRING_ID' => false],
            'select' => ['ID', 'STRING_ID'],
            'cache' => [
                'ttl' => self::CACHE_TTL
            ],
        ))->fetchAll(), 'ID', 'STRING_ID');

        return $userGroups;
    }

    private static function getUserGroupArray($userId = false)
    {
        global $USER;
        if ($userId) {
            return $USER::GetUserGroup($userId);
        }
        return $USER->GetUserGroupArray();
    }

    private static function getGroupId($groupCode)
    {
        return array_get(self::getUserGroups(), $groupCode, '0');
    }

    public function isConsultant(int $userId): bool
    {
        $consultantGroupId = GroupTable::getRow([
            'filter' => [
                '=STRING_ID' => self::CONSULTANT_GROUP,
            ],
            'select' => ['ID'],
            'cache' => [
                'ttl' => self::CACHE_TTL
            ],
        ])['ID'];

        return (bool) UserGroupTable::getRow([
            'filter' => [
                '=USER_ID' => $userId,
                '=GROUP_ID' => $consultantGroupId,
            ],
            'cache' => [
                'ttl' => self::CACHE_TTL
            ],
        ]);
    }

    public function isBuyer(int $userId): bool
    {
        return in_array(self::getGroupId(self::BUYER_GROUP), self::getUserGroupArray($userId));
    }
}