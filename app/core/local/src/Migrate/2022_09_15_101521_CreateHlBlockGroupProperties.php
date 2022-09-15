<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\GroupPropertySeeder;

final class CreateHlBlockGroupProperties extends BaseCreateHighloadMigration
{
    protected ?string $seeder = GroupPropertySeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HlGroupProperties',
        'TABLE_NAME' => 'group_properties',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок свойств ролей пользователя',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_GROUP_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_GROUP_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Идентификатор группы'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Идентификатор группы'],
            'LIST_FILTER_LABEL' => ['ru' => 'Идентификатор группы'],
        ],
        [
            'FIELD_NAME' => 'UF_DISCOUNT',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_DISCOUNT',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Размер скидки'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Размер скидки'],
            'LIST_FILTER_LABEL' => ['ru' => 'Размер скидки'],
            'SETTINGS' => [
                'MIN_LENGTH' => 0,
                'MAX_LENGTH' => 100,
                'DEFAULT_VALUE' => [
                    'TYPE' => 'INTEGER',
                    'VALUE' => 0,
                ],
            ],
        ],
    ];
}
