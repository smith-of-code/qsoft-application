<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateHlBlockSliderElement extends BaseCreateHighloadMigration
{
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
            'EDIT_FORM_LABEL' => ['ru' => 'Заголовок'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Заголовок'],
            'LIST_FILTER_LABEL' => ['ru' => 'Заголовок'],
        ],
        [
            'FIELD_NAME' => 'UF_TYPE',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_TYPE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Тип'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Тип'],
            'LIST_FILTER_LABEL' => ['ru' => 'Тип'],
        ],
        [
            'FIELD_NAME' => 'UF_ELEMENT_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_ELEMENT_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Идентификатор элемента баннера'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Идентификатор элемента баннера'],
            'LIST_FILTER_LABEL' => ['ru' => 'Идентификатор элемента баннера'],
        ],
    ];

    protected array $enumValues = [
        'UF_TYPE' => [
            [
                'XML_ID' => 'BANNER',
                'VALUE' => 'Баннер',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            [
                'XML_ID' => 'PRODUCT',
                'VALUE' => 'Товар',
                'DEF' => 'N',
                'SORT' => 20,
            ],
        ],
    ];
}
