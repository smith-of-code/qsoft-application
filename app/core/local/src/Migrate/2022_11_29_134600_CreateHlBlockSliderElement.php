<?php

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\UserFieldTable;
use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\SliderElementSeeder;

final class CreateHlBlockSliderElement extends BaseCreateHighloadMigration
{
    protected ?string $seeder = SliderElementSeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HlSliderElement',
        'TABLE_NAME' => 'slider_element',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок элементов слайдера',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_SLIDER_ID',
            'USER_TYPE_ID' => 'hlblock',
            'XML_ID' => 'UF_SLIDER_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Слайдер'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Слайдер'],
            'LIST_FILTER_LABEL' => ['ru' => 'Слайдер'],
            'MANDATORY' => 'Y',
            "SETTINGS" => [
                "DISPLAY" => "LIST",
                "LIST_HEIGHT" => 5,
                "HLBLOCK_ID" => 0,
                "HLFIELD_ID" => 0,
                "DEFAULT_VALUE" => 0,
            ]
        ],
        [
            'FIELD_NAME' => 'UF_TYPE',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_TYPE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Тип'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Тип'],
            'LIST_FILTER_LABEL' => ['ru' => 'Тип'],
            'MANDATORY' => 'Y',
        ],
        [
            'FIELD_NAME' => 'UF_ELEMENT_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_ELEMENT_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'ID товара/баннера'],
            'LIST_COLUMN_LABEL' => ['ru' => 'ID товара/баннера'],
            'LIST_FILTER_LABEL' => ['ru' => 'ID товара/баннера'],
            'MANDATORY' => 'Y',
        ],
        [
            'FIELD_NAME' => 'UF_SORT',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_SORT',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Сортировка'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Сортировка'],
            'LIST_FILTER_LABEL' => ['ru' => 'Сортировка'],
        ],
    ];

    protected array $enumValues = [
        'UF_TYPE' => [
            'n1' => [
                'XML_ID' => 'BANNER',
                'VALUE' => 'Баннер',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'PRODUCT',
                'VALUE' => 'Товар',
                'DEF' => 'N',
                'SORT' => 20,
            ],
        ],
    ];

    protected function beforeUp(): void
    {
        $this->includeHighloadModule();

        // Получим ID HL-блока слайдеров для создания свойства с привязкой
        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => 'HlSlider']]);
        if (! $hlBlock) {
            throw new \RuntimeException(sprintf('Не найден hl-блок %s', 'HlSlider'));
        }

        // Получим ID поля HL-блока слайдеров, к которому будет выполнена привязка
        $field = UserFieldTable::getList([
            'filter' => [
                'ENTITY_ID' => 'HLBLOCK_' . $hlBlock['ID'],
                'FIELD_NAME' => 'UF_TITLE',
            ],
        ])->fetch();

        if (! $field) {
            throw new \RuntimeException(sprintf('Не найдено свойство %s', 'UF_TITLE'));
        }

        $this->fields[0]['SETTINGS'] = [
            'HLBLOCK_ID' => $hlBlock['ID'],
            'HLFIELD_ID' => $field['ID'],
        ];
    }
}
