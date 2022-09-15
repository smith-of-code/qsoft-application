<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateHlBlockRelatedProduct extends BaseCreateHighloadMigration
{
    protected array $blockInfo = [
        'NAME'       => 'HlRelatedProduct',
        'TABLE_NAME' => 'related_product',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок сопустствующих товаров',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_MAIN_PRODUCT_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_MAIN_PRODUCT_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Заголовок основного товара'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Заголовок основного товара'],
            'LIST_FILTER_LABEL' => ['ru' => 'Заголовок основного товара'],
        ],
        [
            'FIELD_NAME' => 'UF_RELATED_PRODUCT_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_RELATED_PRODUCT_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Заголовок сопутствующего товара'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Заголовок сопутствующего товара'],
            'LIST_FILTER_LABEL' => ['ru' => 'Заголовок сопутствующего товара'],
        ],
    ];
}
