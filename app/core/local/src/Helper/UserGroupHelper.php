<?php

namespace QSoft\Helper;

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
            'cache' => ['ttl' => 31536000], // Кешируем на 1 год
        ]);
        while ($group = $groupsRes->fetch()) {
            $allGroups[$group['STRING_ID']] = $group['ID'];
        }
        return $allGroups;
    }

    static public function getConsultantGroupId(): int
    {
        return GroupTable::getRow([
            'filter' => [
                '=STRING_ID' => 'consultant',
            ],
            'select' => ['ID'],
            'cache' => ['ttl' => 86400],
        ])['ID'];
    }
}