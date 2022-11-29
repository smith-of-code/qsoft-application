<?php

use QSoft\Migration\Migration;

class NonreturnableProductProperty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $this->includeIBlockModule();
        $iblockId = IBLOCK_PRODUCT;
        $this->addProperties($iblockId);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $this->includeIBlockModule();
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
            (new CIBlockProperty)->add($propertyFields);
        }
    }

    /**
     * @param int $iblockId
     *
     * @return void
     */
    private function deleteProperties(int $iblockId):void
    {
        $propertiesId = $this->getPropertiesIdByCodes($iblockId);

        foreach ($propertiesId as $id) {
            $properiesResult = CIBlockProperty::delete($id);
        }
    }

    /**
     * @return [type]
     */
    private function getPropertiesIdByCodes($iblockId)
    {
        $properties = $this->preparePropertiesFieldsForAdd($iblockId);

        foreach ($properties as $property) {
            $ids[] = CIBlockProperty::GetList(
                ["SORT" => "ASC"],
                [
                    "ACTIVE"    => "Y",
                    "CODE" => $property['CODE'],
                ]
            )->GetNext()['ID'];
        }

        return $ids ?? [];
    }

    /**
     * @return void
     */
    protected function includeIBlockModule(): void
    {
        if (!CModule::IncludeModule('iblock')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
        }

        if (!CModule::IncludeModule('sale')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
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
                'NAME' => 'Невозвратный товар',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'NONRETURNABLE_PRODUCT',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'L',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'C',
                'MULTIPLE' => 'N',
                'XML_ID' => 'NONRETURNABLE_PRODUCT',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'N',
                'VALUES' => [
                    [
                        'VALUE' => 'Да',
                        'DEF' => 'N',
                        'SORT' => 500,
                        'XML_ID' => 'yes',
                    ],
                ],
                'VERSION' => '1',
                'USER_TYPE' => NULL,
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
        ];
    }
}