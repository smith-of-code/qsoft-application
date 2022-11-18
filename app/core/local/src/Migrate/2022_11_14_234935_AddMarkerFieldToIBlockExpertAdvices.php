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

class AddMarkerFieldToIBlockExpertAdvices extends AbstractMigration {

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
        'TARGET_AUDIENCE', 'MARKER',
    ];

    private $onDownAddProperty = [
        [
            'NAME' => 'Целевая аудитория',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'TARGET_AUDIENCE',
            'IS_REQUIRED' => 'Y',
        ],
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
                [
                    'VALUE' => 'AmeБизнес',
                    'DEF' => 'N',
                    'XML_ID' => 'AMEBUSINESS',
                    'SORT' => 2000,
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
            'filter' => ['CODE' => 'expert_advice']
        ]);
        if (! $iblock) {
            throw new \RuntimeException("Не найден инфоблок Новости с кодом CODE = expert_advice");
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
            'filter' => ['CODE' => 'expert_advice']
        ]);
        if (! $iblock) {
            throw new \RuntimeException("Не найден инфоблок Новости с кодом CODE = expert_advice");
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