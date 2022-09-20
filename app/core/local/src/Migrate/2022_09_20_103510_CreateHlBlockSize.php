<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\SizeSeeder;

final class CreateHlBlockSize extends BaseCreateHighloadMigration
{
    protected ?string $seeder = SizeSeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HlSizes',
        'TABLE_NAME' => 'size',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок размеров',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_NAME',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Описание размера'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Описание размера'],
            'LIST_FILTER_LABEL' => ['ru' => 'Описание размера'],
        ],
        [
            'FIELD_NAME' => 'UF_XML_ID',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_XML_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'XML_ID'],
            'LIST_COLUMN_LABEL' => ['ru' => 'XML_ID'],
            'LIST_FILTER_LABEL' => ['ru' => 'XML_ID'],
        ],
    ];
}
