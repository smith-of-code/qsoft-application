<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateHlBlockDocuments extends BaseCreateHighloadMigration
{
    protected ?string $seeder = null;

    protected array $blockInfo = [
        'NAME' => 'HlDocuments',
        'TABLE_NAME' => 'documents',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок документов',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_NAME',
            'SORT' => 100,
            'MANDATORY' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'Название'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Название'],
            'LIST_FILTER_LABEL' => ['ru' => 'Название'],
        ],
        [
            'FIELD_NAME' => 'UF_DOCUMENT',
            'USER_TYPE_ID' => 'file',
            'XML_ID' => 'UF_DOCUMENT',
            'SORT' => 100,
            'MULTIPLE' => 'Y',
            'MANDATORY' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'Документ(ы)'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Документ(ы)'],
            'LIST_FILTER_LABEL' => ['ru' => 'Документ(ы)'],
        ],
    ];
}