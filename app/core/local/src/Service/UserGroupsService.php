<?php

namespace QSoft\Service;

use Bitrix\Main\GroupTable;
use Bitrix\Main\UserGroupTable;
use http\Exception\RuntimeException;
use QSoft\Entity\User;
use QSoft\Helper\UserGroupHelper;

class UserGroupsService
{
    private User $user;
    /**
     * @var array Группы, в которых состоит пользователь
     */
    private array $groups;

    public const USER_GROUP_BUYER = 'buyer';
    public const USER_GROUP_CONSULTANT = 'consultant';

    /**
     * UserGroupsService constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
        $this->groups = [];
    }

    /**
     * Возвращает группы, в которых состоит пользователь, в виде пар соответствия символьного идентификатора и ID группы
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
                'cache' => ['ttl' => 86400], // Кешируем на 1 сутки
            ]);
            while ($group = $groupsRes->fetch()) {
                $this->groups[$group['GROUP_CODE']] = $group['GROUP_ID'];
            }
        }
        return $this->groups;
    }

    /**
     * Добавляет пользователя в группу
     * @param int $groupCode Символьный код группы (STRING_ID)
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function addToGroup(int $groupCode) : bool
    {
        // Получим группы, если они ещё не были запрошены
        $allGroups = UserGroupHelper::getAllUserGroups();
        $this->getUserGroups();

        if (! isset($this->allGroups[$groupCode])) {
            throw new RuntimeException('User group does not exist');
        }

        // Добавим в группу
        UserGroupTable::add([
            'GROUP_ID' => $allGroups[$groupCode],
            'USER_ID' => $this->user->id
        ]);
        $this->groups[$groupCode] = $allGroups[$groupCode];

        return true;
    }

    /**
     * Удаляет пользователя из группы
     * @param int $groupCode Символьный код группы (STRING_ID)
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function removeFromGroup(int $groupCode) : bool
    {
        // Получим группы, если они ещё не были запрошены
        $allGroups = UserGroupHelper::getAllUserGroups();
        $this->getUserGroups();

        if (! isset($allGroups[$groupCode])) {
            throw new RuntimeException('User group does not exist');
        }

        // Удалим из группы
        UserGroupTable::delete([
            'GROUP_ID' => $allGroups[$groupCode],
            'USER_ID' => $this->user->id
        ]);
        unset($this->groups[$groupCode]);

        return true;
    }

    /**
     * Относится ли пользователь к группе с заданным символьным идентификатором
     * @param string $groupCode Символьный идентификатор группы (STRING_ID)
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
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
        return $this->isInAGroup(self::USER_GROUP_CONSULTANT);
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