<?php

namespace QSoft\Service;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\GroupTable;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\UserGroupTable;

class UserGroupsService
{
    public const CONSULTANT_GROUP = 'consultant';

    /**
     * @param int $userId
     * @return bool
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
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

    public function currentUserIsConsultant(): bool
    {
        global $USER;
        return $USER->GetID() && $this->isConsultant($USER->GetID());
    }
}