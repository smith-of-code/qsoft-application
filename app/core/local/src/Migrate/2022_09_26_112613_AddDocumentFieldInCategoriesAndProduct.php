<?php

use Bitrix\Main\DB\Connection;
use QSoft\Migrate\AbstractMigration;
use Bitrix\Main\Loader;

final class AddDocumentFieldInCategoriesAndProduct extends AbstractMigration
{
    public function onUp(Connection $connection): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
        }

        $iBlockId = CIBlock::GetList([], ['CODE' => 'product'])->Fetch()['ID'];
        if (!$iBlockId) {
            throw new RuntimeException('Не найден инфоблок "product"');
        }

        $iBlockProperty = new CIBlockProperty();
        if (!$iBlockProperty->Add([
            'IBLOCK_ID' => $iBlockId,
            'NAME' => 'Документы',
            'CODE' => 'DOCUMENTS',
            'PROPERTY_TYPE' => 'F',
            'MULTIPLE' => 'Y',
        ])) {
            throw new RuntimeException('Ошибка при создании свойства "Документы"');
        }

        $entityManager = new CUserTypeEntity();
        if (!$entityManager->Add([
            'ENTITY_ID' => 'IBLOCK_' . $iBlockId . '_SECTION',
            'FIELD_NAME' => 'UF_DOCUMENTS',
            'USER_TYPE_ID' => 'file',
            'XML_ID' => 'UF_DOCUMENTS',
            'MULTIPLE' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'Документы'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Документы'],
            'LIST_FILTER_LABEL' => ['ru' => 'Документы'],
        ])) {
            throw new RuntimeException('Ошибка при создании свойства "Документы" в секциях');
        }
    }

    public function onDown(Connection $connection): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
        }

        $iBlockId = CIBlock::GetList([], ['CODE' => 'product'])->Fetch()['ID'];
        if (!$iBlockId) {
            throw new RuntimeException('Не найден инфоблок "product"');
        }

        $documentsProperty = CIBlockProperty::GetList([], ['IBLOCK_ID' => $iBlockId, 'CODE' => 'DOCUMENTS'])->Fetch();
        if (!$documentsProperty) {
            throw new RuntimeException('Не найдено свойство "Документы"');
        }

        if (!CIBlockProperty::Delete($documentsProperty['ID'])) {
            throw new RuntimeException('Ошибка при удалении свойства "Документы"');
        }
    }
}
