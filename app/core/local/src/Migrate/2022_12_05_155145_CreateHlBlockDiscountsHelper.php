<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateHlBlockDiscountsHelper extends BaseCreateHighloadMigration
{
    protected ?string $seeder = null;

    protected array $blockInfo = [
        'NAME' => 'HlDiscountsHelper',
        'TABLE_NAME' => 'discounts_helper',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок правил работы с корзиной',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_DISCOUNT_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_DISCOUNT_ID',
            'SORT' => 100,
            'MANDATORY' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'ID правила работы с корзиной'],
            'LIST_COLUMN_LABEL' => ['ru' => 'ID правила работы с корзиной'],
            'LIST_FILTER_LABEL' => ['ru' => 'ID правила работы с корзиной'],
        ],
        [
            'FIELD_NAME' => 'UF_LINK',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_LINK',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Ссылка'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Ссылка'],
            'LIST_FILTER_LABEL' => ['ru' => 'Ссылка'],
        ],
        [
            'FIELD_NAME' => 'UF_IMAGE',
            'USER_TYPE_ID' => 'file',
            'XML_ID' => 'UF_IMAGE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Изображение'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Изображение'],
            'LIST_FILTER_LABEL' => ['ru' => 'Изображение'],
        ],
        [
            'FIELD_NAME' => 'UF_AMOUNT',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_AMOUNT',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Размер скидки'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Размер скидки'],
            'LIST_FILTER_LABEL' => ['ru' => 'Размер скидки'],
        ],
    ];
}