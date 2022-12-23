<?php

use QSoft\Migration\Migration;

class CreateSectionsUserField extends Migration
{
    private const FIELD = [
        'FIELD_NAME' => 'UF_ADDITIONAL_PRODUCTS_TABS',
        'USER_TYPE_ID' => 'enumeration',
        'XML_ID' => 'UF_ADDITIONAL_PRODUCTS_TABS',
        'SORT' => 100,
        'MULTIPLE' => 'Y',
        'EDIT_FORM_LABEL' => ['ru' => 'Дополнительные табы товаров(на детальной странице)'],
        'LIST_COLUMN_LABEL' => ['ru' => 'Дополнительные табы товаров(на детальной странице)'],
        'LIST_FILTER_LABEL' => ['ru' => 'Дополнительные табы товаров(на детальной странице)'],
    ];

    private const VALUES = [
        'n1' => [
            'VALUE' => 'Состав',
            'XML_ID' => 'COMPOSITION',
            'DEF' => 'N',
            'SORT' => 10,
        ],
        'n2' => [
            'VALUE' => 'Рекомендации по кормлению',
            'XML_ID' => 'FEEDING_ADVICE',
            'DEF' => 'N',
            'SORT' => 10,
        ],
    ];

    public function up()
    {
        $userTypeEntity = new CUserTypeEntity;
        $userFieldEnum = new CUserFieldEnum;
        $fieldId = $userTypeEntity->Add(['ENTITY_ID' => $this->getEntityId()] + self::FIELD);
        if (!$fieldId) {
            throw new RuntimeException('Не удалось добавить поле');
        }
        $result = $userFieldEnum->SetEnumValues($fieldId, self::VALUES);
        if (!$result) {
            throw new RuntimeException('Не удалось добавить поле');
        }
    }

    public function down()
    {
        $userTypeEntity = new CUserTypeEntity;
        $field = $userTypeEntity->GetList([], ['ENTITY_ID' => $this->getEntityId(), 'FIELD_NAME' => self::FIELD['FIELD_NAME']])->Fetch();
        if ($field) {
            $userTypeEntity->Delete($field['ID']);
        }
    }

    private function getEntityId(): string
    {
        return 'IBLOCK_' . IBLOCK_PRODUCT . '_SECTION';
    }
}