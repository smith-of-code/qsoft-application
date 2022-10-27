<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use QSoft\Migration\Migration;
use Bitrix\Iblock\Model\PropertyFeature;

class NewPropertiesForCatalogProduct extends Migration
{
    // свойства для показа на деталке
    private const ON_DETAIL_PAGE = [
        'SPECIAL_INDICATIONS',
        'FEED_TASTE',
        'MATERIAL',
        'BREED',
        'AGE',
    ];     

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $iblockId = IBLOCK_PRODUCT;
        $this->addProperties($iblockId);
        $this->updateProperties($iblockId);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $iblockId = IBLOCK_PRODUCT;
        $this->deleteProperties($iblockId);
    }

    /**
     * @param int $iblockId
     * 
     * @return void
     */
    private function addProperties(int $iblockId): void
    {
        $properties = $this->preparePropertiesFieldsForAdd($iblockId);

        foreach ($properties as $propertyFields) {
            $id = (new CIBlockProperty())->add($propertyFields);

            if (in_array($propertyFields['CODE'], self::ON_DETAIL_PAGE)) {
                PropertyFeature::setFeatures(
                    $id, 
                    [
                        "FEATURE_ID" => "DETAIL_PAGE_SHOW",
                        "IS_ENABLED" => "Y",
                        "MODULE_ID" => "iblock",
                    ]
                );
            }
        }
    }

    /**
     * @param int $iblockId
     * 
     * @return void
     */
    private function updateProperties(int $iblockId): void
    {
        $properties = $this->preparePropertiesFieldsForUpdate($iblockId);

        $propertiesId = $this->getPropertiesIdByCodes($iblockId);

        foreach ($properties as $propertyFields) {
            (new CIBlockProperty())->update($propertiesId[$propertyFields['CODE']], $propertyFields);

            if (in_array($propertyFields['CODE'], self::ON_DETAIL_PAGE)) {
                PropertyFeature::setFeatures(
                    $propertyFields['ID'], 
                    [
                        "FEATURE_ID" => "DETAIL_PAGE_SHOW",
                        "IS_ENABLED" => "Y",
                        "MODULE_ID" => "iblock",
                    ]
                );
            }
        }
    }

    /**
     * @param int $iblockId
     * 
     * @return void
     */
    private function deleteProperties(int $iblockId):void
    {
        $properties = $this->preparePropertiesFieldsForAdd($iblockId);

        $propertiesId = $this->getPropertiesIdByCodes($properties);

        foreach ($propertiesId as $id) {
            $properiesResult = CIBlockProperty::delete($id);
        }
    }

    /**
     * @return [type]
     */
    private function getPropertiesIdByCodes()
    {
        $properties = $this->preparePropertiesFieldsForAdd($this->arParams['IBLOCK_ID']);

        foreach ($properties as $property) {
            $ids[] = CIBlockProperty::GetList(
                ["SORT" => "ASC"],
                [
                    "ACTIVE"    => "Y",
                    "CODE" => $property['CODE'],
                ]
            )->GetNext()['Id'];
        }

        return $ids ?? [];
    }

    /**
     * @return void
     */
    protected function includeIBlockModule(): void
    {
        if (!\CModule::IncludeModule('iblock')) {
            throw new \RuntimeException('Не удалось подключить модуль iblock');
        }

        if (!\CModule::IncludeModule('sale')) {
            throw new \RuntimeException('Не удалось подключить модуль iblock');
        }
    }

    /**
     * @param int $iblockId
     * 
     * @return array
     */
    private function preparePropertiesFieldsForAdd(int $iblockId): array
    {
        return [
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Специальные показания',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'SPECIAL_INDICATIONS',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'SPECIAL_INDICATIONS',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Вкус корма',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'FEED_TASTE',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'FEED_TASTE',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Детали',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'PRODUCT_DETAILS',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'Y',
                'XML_ID' => 'PRODUCT_DETAILS',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '2',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Сырая зола, %',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'ROW_ASH',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'ROW_ASH',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Фосфор, %',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'PRHOSPHORUS',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'PRHOSPHORUS',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Кальций, %',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'CALCIUM',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'CALCIUM',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Сырая клетчатка, %',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'CRUDE_FIBRE',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'CRUDE_FIBRE',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Жир, %',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'ENERGY',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'ENERGY',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Протеин, %',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'PROTEIN',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'PROTEIN',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Протеин, %',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'PROTEIN',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'PROTEIN',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
        ];
    }

    /**
     * @param int $iblockId
     * 
     * @return array
     */
    private function preparePropertiesFieldsForUpdate(int $iblockId): array
    {
        return [
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Состав',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'COMPOSITION',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'COMPOSITION',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Материал',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'MATERIAL',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'MATERIAL',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Возраст',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'AGE',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'AGE',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Размер породы',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'BREED',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'BREED',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
            [
                "IBLOCK_ID" => $iblockId,
                'NAME' => 'Детали',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'PRODUCT_DETAILS',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'PRODUCT_DETAILS',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'Y',
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
        ];
    }
}