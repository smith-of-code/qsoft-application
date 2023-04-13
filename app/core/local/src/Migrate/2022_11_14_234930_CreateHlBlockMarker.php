<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\SliderSeeder;

final class CreateHlBlockMarker extends BaseCreateHighloadMigration
{
    protected ?string $seeder = SliderSeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HlMarker',
        'TABLE_NAME' => 'marker',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок маркеров новостей, мероприятий, советов эксперта',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_NAME',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Название'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Название'],
            'LIST_FILTER_LABEL' => ['ru' => 'Название'],
        ],
        [
            'FIELD_NAME' => 'UF_XML_ID',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_XML_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Символьный код маркера'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Символьный код маркера'],
            'LIST_FILTER_LABEL' => ['ru' => 'Символьный код маркера'],
        ],
    ];
}