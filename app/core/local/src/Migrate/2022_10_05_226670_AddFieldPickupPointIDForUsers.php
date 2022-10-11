<?php

use QSoft\Migrate\Traits\AddUserFieldsTrait;
use QSoft\Migration\Migration;

class AddFieldPickupPointIDForUsers extends Migration
{
    use AddUserFieldsTrait;

    private string $entity = 'USER';

    private array $userFields = [
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_PICKUP_POINT_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => '',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'Y',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => '',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => [
                'DEFAULT_VALUE' => 0,
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'ID пункта выдачи',
                'en' => 'Pickup point ID',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'ID пункта выдачи',
                'en' => 'Pickup point ID',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'ID пункта выдачи',
                'en' => 'Pickup point ID',
            ],
        ],
    ];
}