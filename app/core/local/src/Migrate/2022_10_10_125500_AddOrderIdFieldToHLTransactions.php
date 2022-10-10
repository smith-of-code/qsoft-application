<?php

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\DB\Connection;
use QSoft\Migrate\AbstractMigration;
use Bitrix\Main\Loader;

final class AddOrderIdFieldToHLTransactions extends AbstractMigration
{
    /**
     * @throws \Bitrix\Main\LoaderException
     */
    public function onUp(Connection $connection): void
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }

        $hlblock = HighloadBlockTable::getList(array(
                'filter' => array(
                    'TABLE_NAME' => 'transaction',
                ))
        )->fetch();

        if (!$hlblock) {
            throw new RuntimeException('Не найден HL-блок "HlTransaction"');
        }

        $userTypeEntity = new CUserTypeEntity();

        $arField = array(
            'ENTITY_ID' => 'HLBLOCK_' . $hlblock['ID'],
            'FIELD_NAME' => 'UF_ORDER_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_ORDER_ID',
            'SORT' => 100,
            'MULTIPLE' => 'N',
            'SHOW_FILTER' => 'I',
            'IS_SEARCHABLE' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'ID заказа'],
            'LIST_COLUMN_LABEL' => ['ru' => 'ID заказа'],
            'LIST_FILTER_LABEL' => ['ru' => 'ID заказа'],
        );

        $fieldId = $userTypeEntity->Add($arField);

        if (! $fieldId) {
            throw new \http\Exception\RuntimeException('Не удалось добавить поле UF_ORDER_ID');
        }
    }

    public function onDown(Connection $connection): void
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }

        $hlblock = HighloadBlockTable::getList(array(
                'filter' => array(
                    'TABLE_NAME' => 'transaction',
                ))
        )->fetch();

        if (!$hlblock) {
            throw new RuntimeException('Не найден HL-блок "HlTransaction"');
        }

        $userTypeEntity = new CUserTypeEntity();

        $fieldId = CUserFieldEnum::GetList([], ['XML_ID' => 'UF_ORDER_ID'])->Fetch()['ID'];

        $userTypeEntity->Delete($fieldId);
    }
}
