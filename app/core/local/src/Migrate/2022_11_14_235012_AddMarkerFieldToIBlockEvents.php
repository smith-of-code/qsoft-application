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

class AddMarkerFieldToIBlockEvents extends AbstractMigration {

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
        'EVENT_DATE', 'EVENT_TYPE',
    ];

    private $onDownAddProperty = [
        [
            'NAME' => 'Дата проведения',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'EVENT_DATE',
            'IS_REQUIRED' => 'Y',
            'USER_TYPE' => 'DateTime',
        ],
        [
            'NAME' => 'Тип',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'EVENT_TYPE',
            'IS_REQUIRED' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Онлайн',
                    'XML_ID' => 'online',
                    'DEF' => 'N',
                    'SORT' => 500,
                ],
                [
                    'VALUE' => 'Оффлайн',
                    'XML_ID' => 'offline',
                    'DEF' => 'N',
                    'SORT' => 500,
                ],
            ],
        ],
    ];
    private $onDownDeleteProperty = [
        'HL_MARKER'
    ];

    protected function onUp(Connection $connection): void
    {
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
            'filter' => ['CODE' => 'event']
        ]);
        if (! $iblock) {
            throw new \RuntimeException("Не найден инфоблок Новости с кодом CODE = event");
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
            'filter' => ['CODE' => 'event']
        ]);
        if (! $iblock) {
            throw new \RuntimeException("Не найден инфоблок Новости с кодом CODE = event");
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