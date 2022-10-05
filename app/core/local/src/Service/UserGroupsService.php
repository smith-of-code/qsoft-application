<?php

namespace QSoft\Service;

use Bitrix\Main\GroupTable;
use Bitrix\Main\UserGroupTable;
use QSoft\Entity\User;

class UserGroupsService
{
    private User $user;

    public const USER_GROUP_BUYER = 'buyer';
    public const USER_GROUP_CONSULTANT_1 = 'consultant_1';
    public const USER_GROUP_CONSULTANT_2 = 'consultant_2';
    public const USER_GROUP_CONSULTANT_3 = 'consultant_3';

    /**
     * UserGroupsService constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Относится ли пользователь к группе с заданным символьным идентификатором
     * @param string $groupCode Символьный идентификатор (STRING_ID)
     * @return bool
     */
    public function isInAGroup(string $groupCode): bool
    {
        $groupId = GroupTable::getRow([
            'filter' => [
                '=STRING_ID' => $groupCode,
            ],
            'select' => ['ID'],
        ])['ID'];
        return (bool) UserGroupTable::getRow([
            'filter' => [
                '=USER_ID' => $this->user->id,
                '=GROUP_ID' => $groupId,
            ],
        ]);
    }

    /**
     * Является ли пользователь Консультантом
     * @return bool
     */
    public function isConsultant(): bool
    {
        return $this->isInAGroup(self::USER_GROUP_CONSULTANT_1)
            || $this->isInAGroup(self::USER_GROUP_CONSULTANT_2)
            || $this->isInAGroup(self::USER_GROUP_CONSULTANT_3);
    }

    /**
     * Является ли пользователь Конечным покупателем
     * @return bool
     */
    public function isBuyer(): bool
    {
        return $this->isInAGroup(self::USER_GROUP_BUYER);
    }
}