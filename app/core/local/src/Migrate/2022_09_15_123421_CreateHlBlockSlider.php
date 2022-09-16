<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\SliderSeeder;

final class CreateHlBlockSlider extends BaseCreateHighloadMigration
{
    protected ?string $seeder = SliderSeeder::class;

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
            'EDIT_FORM_LABEL' => ['ru' => 'Заголовок'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Заголовок'],
            'LIST_FILTER_LABEL' => ['ru' => 'Заголовок'],
        ],
    ];
}
