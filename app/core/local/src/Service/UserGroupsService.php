<?php

namespace QSoft\Service;

use Bitrix\Main\GroupTable;
use Bitrix\Main\UserGroupTable;
use QSoft\Entity\User;

class UserGroupsService
{
    private User $user;
    /**
     * @var array Группы, в которых состоит пользователь
     */
    private array $groups;
    /**
     * @var array Все группы пользователей
     */
    private array $allGroups;

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
        $this->groups = [];
        $this->allGroups = [];
    }

    /**
     * Возвращает группы, в которых состоит пользователь
     * @return array Массив пар "STRING_ID" - "ID"
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getUserGroups() : array
    {
        if (empty($this->groups)) {
            $groupsRes = UserGroupTable::getList([
                'filter' => ['USER_ID' => $this->user->id],
                'select' => ['GROUP_ID','GROUP_CODE'=>'GROUP.STRING_ID'],
            ]);
            while ($group = $groupsRes->fetch()) {
                $this->groups[$group['GROUP_CODE']] = $group['GROUP_ID'];
            }
        }
        return $this->groups;
    }

    /**
     * Возвращает все группы пользователей
     * @return array Массив пар "STRING_ID" - "ID"
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getAllUserGroups() : array
    {
        if (empty($this->allGroups)) {
            $groupsRes = GroupTable::getList([
                'select' => ['ID','STRING_ID'],
            ]);
            while ($group = $groupsRes->fetch()) {
                $this->allGroups[$group['GROUP_CODE']] = $group['GROUP_ID'];
            }
        }
        return $this->allGroups;
    }

    /**
     * Относится ли пользователь к группе с заданным символьным идентификатором
     * @param string $groupCode Символьный идентификатор группы (STRING_ID)
     * @return bool
     */
    public function isInAGroup(string $groupCode): bool
    {
        $this->getUserGroups();
        return in_array($groupCode, array_keys($this->groups), true);
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