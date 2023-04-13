<?php

use QSoft\Migrate\Traits\AddUserFieldsTrait;
use QSoft\Migration\Migration;

class AddConfirmEmailUserField extends Migration
{
    use AddUserFieldsTrait;

    private string $entity = 'USER';

    private array $userFields = [
        [
            'ENTITY_ID' => 'USER',
            'FIELD_NAME' => 'UF_EMAIL_CONFIRMED',
            'USER_TYPE_ID' => 'boolean',
            'XML_ID' => '',
            'SORT' => '500',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => '',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => [
                'DEFAULT_VALUE' => '',
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Email подтвержден',
                'en' => 'Email is confirmed',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Email подтвержден',
                'en' => 'Email is confirmed',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Email подтвержден',
                'en'=> 'Email is confirmed',
            ],
        ],
    ];
}