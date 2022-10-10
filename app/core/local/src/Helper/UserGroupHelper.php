<?php

namespace QSoft\Service;

use Bitrix\Main\GroupTable;

class UserGroupHelper
{
    /**
     * Возвращает все группы пользователей в виде пар соответствий символьного идентификатора и ID.
     * @return array Массив пар "STRING_ID" - "ID"
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    static public function getAllUserGroups() : array
    {
        $allGroups = [];
        $groupsRes = GroupTable::getList([
            'select' => ['ID','STRING_ID'],
        ]);
        while ($group = $groupsRes->fetch()) {
            $allGroups[$group['GROUP_CODE']] = $group['GROUP_ID'];
        }
        return $allGroups;
    }
}