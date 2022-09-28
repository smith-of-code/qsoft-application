<?php

namespace QSoft\Service;

use Bitrix\Main\GroupTable;
use Bitrix\Main\UserGroupTable;

class UserGroupsService
{
    public const CONSULTANT_GROUP = 'consultant';

    public function isConsultant(int $userId): bool
    {
        $consultantGroupId = GroupTable::getRow([
            'filter' => [
                '=STRING_ID' => self::CONSULTANT_GROUP,
            ],
            'select' => ['ID'],
        ])['ID'];

        return (bool) UserGroupTable::getRow([
            'filter' => [
                '=USER_ID' => $userId,
                '=GROUP_ID' => $consultantGroupId,
            ],
        ]);
    }
}