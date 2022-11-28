<?php

use Bitrix\Main\DB\Connection;
use Bitrix\Main\Loader;
use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\RelatedProductSeeder;

final class CreateHlBlockRelatedProduct extends BaseCreateHighloadMigration
{
    protected ?string $seeder = RelatedProductSeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HlRelatedProduct',
        'TABLE_NAME' => 'related_product',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок сопутствующих товаров',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_MAIN_PRODUCT_ID',
            'USER_TYPE_ID' => 'iblock_element',
            'XML_ID' => 'UF_MAIN_PRODUCT_ID',
            'SORT' => 100,
            'MULTIPLE' => 'N',
            'MANDATORY' => 'Y',
            'SHOW_FILTER' => 'I',
            'IS_SEARCHABLE' => 'N',
            'EDIT_FORM_LABEL' => ['ru' => 'Основной товар'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Основной товар'],
            'LIST_FILTER_LABEL' => ['ru' => 'Основной товар'],
            'SETTINGS' => [
                'DISPLAY' => 'LIST',
                'LIST_HEIGHT' => 5,
                'IBLOCK_ID' => 'product',
                'DEFAULT_VALUE' => '',
                'ACTIVE_FILTER' => 'Y',
            ],
        ],
        [
            'FIELD_NAME' => 'UF_RELATED_PRODUCT_ID',
            'USER_TYPE_ID' => 'iblock_element',
            'XML_ID' => 'UF_RELATED_PRODUCT_ID',
            'SORT' => 110,
            'MULTIPLE' => 'Y',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'I',
            'IS_SEARCHABLE' => 'N',
            'EDIT_FORM_LABEL' => ['ru' => 'Сопутствующие товары'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Сопутствующие товары'],
            'LIST_FILTER_LABEL' => ['ru' => 'Сопутствующие товары'],
            'SETTINGS' => [
                'DISPLAY' => 'LIST',
                'LIST_HEIGHT' => 5,
                'IBLOCK_ID' => 'product',
                'DEFAULT_VALUE' => '',
                'ACTIVE_FILTER' => 'Y',
            ],
        ],
    ];

    protected function onUp(Connection $connection): void
    {
        if (! Loader::includeModule('iblock')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
        }

        // Прописываем ID ИБ
        foreach ($this->fields as $index => $field) {
            $iblockId = \CIBlock::GetList([], ['CODE' => $field['SETTINGS']['IBLOCK_ID']])->Fetch()['ID'];

            if ($iblockId > 0) {
                $this->fields[$index]['SETTINGS']['IBLOCK_ID'] = $iblockId;
            }
        }

        parent::onUp($connection);
    }
}
