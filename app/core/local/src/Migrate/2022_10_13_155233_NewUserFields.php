<?php

use QSoft\Migrate\Traits\AddUserFieldsTrait;
use QSoft\Migration\Migration;

class NewUserFields extends Migration {

    use AddUserFieldsTrait;

    private string $entity = 'SUPPORT';

    private array $userFields = [
        [
            'ENTITY_ID' => 'SUPPORT',
            'FIELD_NAME' => 'UF_DATA',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_DATA',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            "SETTINGS" => [
                "SIZE" => 200,
                "ROWS" => 10,
                "REGEXP" => "",
                "MIN_LENGTH" => 0,
                "MAX_LENGTH" => 0,
                "DEFAULT_VALUE" => "",
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Данные',
                'en' => 'Data',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Данные',
                'en' => 'Data',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Данные',
                'en' => 'Data',
            ],
        ],
        [
            'ENTITY_ID' => 'SUPPORT',
            'FIELD_NAME' => 'UF_ACCEPT_REQUEST',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_ACCEPT_REQUEST',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'VALUES' => [
                'n1' => [
                    'XML_ID' => 'REJECTED',
                    'VALUE' => 'Отклонено',
                    'DEF' => 'N',
                    'SORT' => 100,
                ],
                'n2' => [
                    'XML_ID' => 'ACCEPTED',
                    'VALUE' => 'Принято',
                    'DEF' => 'N',
                    'SORT' => 200,
                ],
            ],
            'SETTINGS' => [
                "DISPLAY" => "CHECKBOX",
                "LIST_HEIGHT" => 3,
                "CAPTION_NO_VALUE" => "",
                "SHOW_NO_VALUE" => "Y",
            ],
            'EDIT_FORM_LABEL' => [
                'ru' => 'Одобрение запроса',
                'en' => 'Accept request',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Одобрение запроса',
                'en' => 'Accept request',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Одобрение запроса',
                'en' => 'Accept request',
            ],
        ],
    ];
}
