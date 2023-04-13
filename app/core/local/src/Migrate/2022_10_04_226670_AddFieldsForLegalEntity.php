<?php

use Bitrix\Main\DB\Connection;
use QSoft\Migrate\AbstractMigration;
use QSoft\Migration\Migration;

class AddFieldsForLegalEntity extends AbstractMigration
{
    protected $hlBlock = HIGHLOAD_BLOCK_HLLEGALENTITIES;

    protected array $fields = [
        'UF_IS_ACTIVE' => [
            'ENTITY_ID' => 'HLBLOCK_{#IBLOCK_ID#}',
            'FIELD_NAME' => 'UF_IS_ACTIVE',
            'USER_TYPE_ID' => 'boolean',
            'XML_ID' => 'UF_IS_ACTIVE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Активность'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Активность'],
            'LIST_FILTER_LABEL' => ['ru' => 'Активность'],
            'SETTINGS' => ['DEFAULT_VALUE' => '1']
        ],
        'UF_DOCUMENTS' => [
            'ENTITY_ID' => 'HLBLOCK_{#IBLOCK_ID#}',
            'FIELD_NAME' => 'UF_DOCUMENTS',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_DOCUMENTS',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Документы'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Документы'],
            'LIST_FILTER_LABEL' => ['ru' => 'Документы'],
        ],
        'UF_CREATED_AT' => [
            'ENTITY_ID' => 'HLBLOCK_{#IBLOCK_ID#}',
            'FIELD_NAME' => 'UF_CREATED_AT',
            'USER_TYPE_ID' => 'datetime',
            'XML_ID' => 'UF_CREATED_AT',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Время создания статуса (время перехода в статус)'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Время создания статуса (время перехода в статус)'],
            'LIST_FILTER_LABEL' => ['ru' => 'Время создания статуса (время перехода в статус)'],
        ],
    ];

    protected function onUp(Connection $connection): void
    {
        global $DB, $APPLICATION;

        $arUFProps = $this->fields;

        $oUserTypeEntity = new CUserTypeEntity();

        $DB->StartTransaction();

        foreach ($arUFProps as $arUFProp) {
            $arUFProp['ENTITY_ID'] = str_replace('{#IBLOCK_ID#}', $this->hlBlock, $arUFProp['ENTITY_ID']);
            $arUFProp['FIELD_NAME'] = mb_strimwidth($arUFProp['FIELD_NAME'], 0, 20);
            $iUserFieldId = $oUserTypeEntity->Add($arUFProp);

            if (!$iUserFieldId) {
                if ($ex = $APPLICATION->GetException()) {
                    $DB->Rollback();
                    $strError = $ex->GetString();
                    throw new RuntimeException($strError);
                }
            }
        }
        $DB->Commit();
    }

    protected function onDown(Connection $connection): void
    {
        global $DB, $APPLICATION;

        $DB->StartTransaction();

        $resUFProps = CUserTypeEntity::GetList([],['ENTITY_ID' => 'HLBLOCK_' . $this->hlBlock]);

        $oUserTypeEntity = new CUserTypeEntity();

        while ($UFProp = $resUFProps->Fetch()) {
            if (array_key_exists($UFProp['XML_ID'], $this->fields)) {
                $iUserFieldId = $oUserTypeEntity->Delete($UFProp['ID']);
                if (!$iUserFieldId) {
                    if ($ex = $APPLICATION->GetException()) {
                        $DB->Rollback();
                        $strError = $ex->GetString();
                        throw new RuntimeException($strError);
                    }
                }
            }
        }

        $DB->Commit();
    }
}
