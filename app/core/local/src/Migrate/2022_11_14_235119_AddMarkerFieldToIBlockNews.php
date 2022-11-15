<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Loader;
use QSoft\Migrate\AbstractMigration;
use Bitrix\Main\DB\Connection;
use \Bitrix\Iblock\IblockTable;

class AddMarkerFieldToIBlockNews extends AbstractMigration {

    private $onUpAddProperty = [
        [
            'NAME' => 'Маркер',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'HL_MARKER',
            'LIST_TYPE' => 'L',
            'IS_REQUIRED' => 'Y',
            'USER_TYPE' => 'directory',
            'USER_TYPE_SETTINGS' => [
                'group' => 'N',
                'multiple' => 'N',
                'TABLE_NAME' => 'marker',
            ]
        ]
    ];
    private $onUpDeleteProperty = [
        'MARKER'
    ];

    private $onDownAddProperty = [
        [
            'NAME' => 'Маркер',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'MARKER',
            'LIST_TYPE' => 'L',
            'IS_REQUIRED' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Кошки',
                    'DEF' => 'N',
                    'XML_ID' => 'CATS',
                    'SORT' => 500,
                ],
                [
                    'VALUE' => 'Собаки',
                    'DEF' => 'N',
                    'XML_ID' => 'DOGS',
                    'SORT' => 1000,
                ],
                [
                    'VALUE' => 'Интересное',
                    'DEF' => 'N',
                    'XML_ID' => 'INTERESTING',
                    'SORT' => 1500,
                ],
            ],
        ]
    ];
    private $onDownDeleteProperty = [
        'HL_MARKER'
    ];

    protected function onUp(Connection $connection): void
    {;
        //Добавление свойства HL_MARKER
        self::addProperty($this->onUpAddProperty);

        //Удаление свойства MARKER
        self::deleteProperty($this->onUpDeleteProperty);

    }

    protected function onDown(Connection $connection): void
    {
        //Удаление свойства HL_MARKER
        self::deleteProperty($this->onDownDeleteProperty);

        //Добавление свойства MARKER
        self::addProperty($this->onDownAddProperty);
    }

    private static function addProperty(array $properties): void
    {
        Loader::includeModule('iblock');
        //Добавление свойства HL_MARKER
        //1 По коду "CODE"=>"news" получить 'ID' инфоблока из b_iblock
        $iblock = IblockTable::getRow([
            'filter' => ['CODE' => 'news']
        ]);
        if (! $iblock) {
            throw new \RuntimeException("Не найден инфоблок Новости с кодом CODE = news");
        }

        //2 Добавить свойства
        foreach ($properties as $property) {
            $property['IBLOCK_ID'] = $iblock['ID'];
            $iBlockProperty = new \CIBlockProperty();
            $result = $iBlockProperty->Add($property);
            if (!$result) {
                throw new \RuntimeException($iBlockProperty->LAST_ERROR);
            }
        }
    }

    private static function deleteProperty(array $codes): void
    {
        Loader::includeModule('iblock');

        //1. По коду "CODE"=>"news" получить 'ID' инфоблока из b_iblock
        $iblock = IblockTable::getRow([
            'filter' => ['CODE' => 'news']
        ]);
        if (! $iblock) {
            throw new \RuntimeException("Не найден инфоблок Новости с кодом CODE = news");
        }

        //2. По 'ID' инфоблока и коду свойства 'CODE'=>'MARKER' получить 'ID' свойства из b_iblock_property
        $properties = PropertyTable::getList([
            'select' => ['ID', 'CODE'],
            'filter' => [
                'IBLOCK_ID' => $iblock['ID'],
                'CODE' => $codes,
            ]
        ])->fetchAll();

        if ($diff = array_diff(array_map(fn($item) => $item['CODE'], $properties), $codes)) {
            throw new \RuntimeException("Не найдены свойства с кодами: " . print_r($diff, true));
        }

        //3. удалить свойство
        $iBlockProperty = new \CIBlockProperty();
        foreach ($properties as $property) {
            $result = $iBlockProperty::Delete($property['ID']);
            if (! $result) {
                throw new \RuntimeException("Не удалось удалить свойство " . $property['CODE'] . ": " . $iBlockProperty->LAST_ERROR);
            }
        }
    }
}

/*
 * $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Маркер',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'HL_MARKER',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'Y',
  'VERSION' => '2',
  'USER_TYPE' => 'directory',
  'USER_TYPE_SETTINGS' =>
  array (
    'size' => 1,
    'width' => 0,
    'group' => 'N',
    'multiple' => 'N',
    'TABLE_NAME' => 'marker',
  ),
  'HINT' => '',
  'FEATURES' =>
  array (
    0 =>
    array (
      'MODULE_ID' => 'iblock',
      'FEATURE_ID' => 'DETAIL_PAGE_SHOW',
      'IS_ENABLED' => 'N',
    ),
    1 =>
    array (
      'MODULE_ID' => 'iblock',
      'FEATURE_ID' => 'LIST_PAGE_SHOW',
      'IS_ENABLED' => 'N',
    ),
  ),
));
        $helper->UserOptions()->saveElementGrid($iblockId, array (
  'views' =>
  array (
    'default' =>
    array (
      'columns' =>
      array (
        0 => '',
      ),
      'columns_sizes' =>
      array (
        'expand' => 1,
        'columns' =>
        array (
 */