<?php

use QSoft\Migrate\Traits\AddUserFieldsTrait;
use QSoft\Migration\Migration;

class AddFieldLoyaltyLevelForUsers extends Migration
{
    use AddUserFieldsTrait;

    private string $entity = 'USER';

    private array $userFields = [
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_LOYALTY_LEVEL',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_LOYALTY_LEVEL',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'Y',
            'SHOW_FILTER' => 'Y',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'Y',
            'VALUES' => [
                'n1' => [
                    'XML_ID' => 'K1',
                    'VALUE' => 'K1',
                    'DEF' => 'Y',
                    'SORT' => 100,
                ],
                'n2' => [
                    'XML_ID' => 'K2',
                    'VALUE' => 'K2',
                    'DEF' => 'N',
                    'SORT' => 200,
                ],
                'n3' => [
                    'XML_ID' => 'K3',
                    'VALUE' => 'K3',
                    'DEF' => 'N',
                    'SORT' => 300,
                ],
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Уровень в системе лояльности',
                'en' => 'Level of loyalty system',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Уровень в системе лояльности',
                'en' => 'Level of loyalty system',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Уровень в системе лояльности',
                'en' => 'Level of loyalty system',
            ],
        ],
    ];
}