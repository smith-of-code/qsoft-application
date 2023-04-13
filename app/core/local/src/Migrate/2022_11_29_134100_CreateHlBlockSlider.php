<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\SliderSeeder;

final class CreateHlBlockSlider extends BaseCreateHighloadMigration
{
    protected array $blockInfo = [
        'NAME'       => 'HlSlider',
        'TABLE_NAME' => 'slider',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок слайдеров',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_TITLE',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_TITLE',
            'SORT' => 100,
            'MANDATORY' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'Название'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Название'],
            'LIST_FILTER_LABEL' => ['ru' => 'Название'],
        ],
        [
            'FIELD_NAME' => 'UF_CODE',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_CODE',
            'SORT' => 100,
            'MANDATORY' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'Символьный код'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Символьный код'],
            'LIST_FILTER_LABEL' => ['ru' => 'Символьный код'],
        ],
    ];
}
