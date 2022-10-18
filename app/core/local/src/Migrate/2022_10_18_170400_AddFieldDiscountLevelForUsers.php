<?php

use QSoft\Migrate\Traits\AddUserFieldsTrait;
use QSoft\Migration\Migration;

class AddFieldDiscountLevelForUsers extends Migration
{
    use AddUserFieldsTrait;

    private string $entity = 'USER';

    private array $userFields = [
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_PERSONAL_DISCOUNT_LEVEL',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_PERSONAL_DISCOUNT_LEVEL',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'Y',
            'SHOW_FILTER' => 'Y',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'Y',
            'VALUES' => [
                'n1' => [
                    'XML_ID' => 'B1',
                    'VALUE' => 'B1',
                    'DEF' => 'Y',
                    'SORT' => 100,
                ],
                'n2' => [
                    'XML_ID' => 'B2',
                    'VALUE' => 'B2',
                    'DEF' => 'N',
                    'SORT' => 200,
                ],
                'n3' => [
                    'XML_ID' => 'B3',
                    'VALUE' => 'B3',
                    'DEF' => 'N',
                    'SORT' => 300,
                ],
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Уровень персональной скидки для Конечного покупателя',
                'en' => 'Level of personal discount for final buyer',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Уровень персональной скидки для Конечного покупателя',
                'en' => 'Level of personal discount for final buyer',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Уровень персональной скидки для Конечного покупателя',
                'en' => 'Level of personal discount for final buyer',
            ],
        ],
    ];
}