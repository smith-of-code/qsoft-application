<?php

use Bitrix\Main\DB\Connection;
use QSoft\Migrate\AbstractMigration;
use QSoft\Migration\Migration;

class AddUsedForHLConfirmation extends AbstractMigration
{
    protected $hlBlock = HIGHLOAD_BLOCK_HLCONFIRMATION;

    protected array $fields = [
        'UF_IS_ACTIVE' => [
            'ENTITY_ID' => 'HLBLOCK_{#IBLOCK_ID#}',
            'FIELD_NAME' => 'UF_IS_USED',
            'USER_TYPE_ID' => 'boolean',
            'XML_ID' => 'UF_IS_USED',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Использован'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Использован'],
            'LIST_FILTER_LABEL' => ['ru' => 'Использован'],
            'SETTINGS' => ['DEFAULT_VALUE' => '0']
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
