<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use QSoft\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProductFeaturesProperty extends Migration
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
                'NAME' => 'Особенности товара',
                'ACTIVE' => 'Y',
                'SORT' => '500',
                'CODE' => 'PRODUCT_FEATURES',
                'DEFAULT_VALUE' => '',
                'PROPERTY_TYPE' => 'S',
                'ROW_COUNT' => '1',
                'COL_COUNT' => '30',
                'LIST_TYPE' => 'L',
                'MULTIPLE' => 'N',
                'XML_ID' => 'PRODUCT_FEATURES',
                'FILE_TYPE' => '',
                'MULTIPLE_CNT' => '5',
                'LINK_IBLOCK_ID' => '0',
                'WITH_DESCRIPTION' => 'N',
                'SEARCHABLE' => 'N',
                'FILTRABLE' => 'N',
                'IS_REQUIRED' => 'N',
                'VERSION' => '1',
                'USER_TYPE' => 'HTML',
                'USER_TYPE_SETTINGS' => NULL,
                'HINT' => '',
            ],
        ];
    }
}