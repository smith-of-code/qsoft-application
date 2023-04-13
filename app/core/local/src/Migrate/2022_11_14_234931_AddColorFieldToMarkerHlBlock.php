<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 */

use Bitrix\Highloadblock\HighloadBlockTable;
use \QSoft\Migrate\AbstractMigration;
use Bitrix\Main\DB\Connection;
use \Bitrix\Main\Loader;

class AddColorFieldToMarkerHlBlock extends AbstractMigration {

    protected array $blockInfo = [
        'NAME'       => 'HlMarker',
        'TABLE_NAME' => 'marker',
    ];

    protected array $colorField = [
        'FIELD_NAME' => 'UF_COLOR',
        'USER_TYPE_ID' => 'hlblock',
        'XML_ID' => 'UF_COLOR',
        'SORT' => 100,
        'EDIT_FORM_LABEL' => ['ru' => 'Цвет'],
        'LIST_COLUMN_LABEL' => ['ru' => 'Цвет'],
        'LIST_FILTER_LABEL' => ['ru' => 'Цвет'],
        'SETTINGS' =>
            array(
                'DISPLAY' => 'LIST',
                'LIST_HEIGHT' => 1,
                'HLBLOCK_ID' => 'ColorReference',
                'HLFIELD_ID' => 'UF_XML_ID',
                'DEFAULT_VALUE' => 0,
            ),
    ];

    protected function onUp(Connection $connection): void
    {
        $this->includeHighloadModule();

        //Получить HLBLOCK_ID ColorReference
        $hlblock_id = HighloadBlockTable::getRow([
            'select' => [
                'ID'
            ],
            'filter' => [
                'NAME' => $this->colorField['SETTINGS']['HLBLOCK_ID'],
            ]
        ])['ID'];

        if (! $hlblock_id) {
            throw new \RuntimeException('Не удалось получить ID hl-блока ColorReference');
        }

        $this->colorField['SETTINGS']['HLBLOCK_ID'] = $hlblock_id;

        //Получить HLFIELD_ID
        $entityManager = new \CUserTypeEntity();
        $hlfield_id = $entityManager::GetList(
            [],
            [
                'ENTITY_ID' => "HLBLOCK_{$hlblock_id}",
                'XML_ID' => $this->colorField['SETTINGS']['HLFIELD_ID'],
            ]
        )->GetNext()['ID'];

        if (! $hlfield_id) {
            throw new \RuntimeException('Не удалось получить ID свойства hl-блока ColorReference');
        }

        $this->colorField['SETTINGS']['HLFIELD_ID'] = $hlfield_id;

        //Получить HLBLOCK_ID Marker
        $hlblock_id = HighloadBlockTable::getRow([
            'select' => [
                'ID'
            ],
            'filter' => [
                'NAME' => $this->blockInfo['NAME'],
            ]
        ])['ID'];

        if (! $hlblock_id) {
            throw new \RuntimeException('Не удалось получить ID hl-блока Marker');
        }

        //добавить свойство
        $entityManager = new \CUserTypeEntity();
        $fieldId = $entityManager->Add(['ENTITY_ID' => "HLBLOCK_{$hlblock_id}"] + $this->colorField);
        if (!$fieldId) {
            throw new \RuntimeException(sprintf('Не удалось добавить поле %s в hl-блок %s', $field['FIELD_NAME'], $this->blockInfo['NAME']));
        }
    }

    protected function onDown(Connection $connection): void
    {
        $this->includeHighloadModule();

        //Получение ID инфоблока HlMarker
        $hlBlock_id = HighloadBlockTable::getRow([
            'select' => [
                'ID'
            ],
            'filter' => [
                'NAME' => $this->blockInfo['NAME'],
            ]
        ])['ID'];

        if (!$hlBlock_id) {
            throw new \RuntimeException(sprintf('Не найден hl-блок %s', $this->blockInfo['NAME']));
        }

        //Получение ID поля UF_COLOR
        $result = \CUserTypeEntity::GetList(
            [],
            [
                'ENTITY_ID' => "HLBLOCK_{$hlBlock_id}",
                'FIELD_NAME' => $this->colorField['FIELD_NAME']
            ]);
        if (!$result) {
            throw new \RuntimeException(sprintf('Не удалось получить список полей hl-блока %s', $this->blockInfo['NAME']));
        }
        $colorFieldId = [];
        while ($fieldId = $result->GetNext()) {
            $colorFieldId[] = $fieldId['ID'];
        }
        if (count($colorFieldId) != 1) {
            throw new \RuntimeException('Получено неверное количество полей для удаления');
        }


        //Удаление поля UF_COLOR
        $result = (new CUserTypeEntity())->Delete($colorFieldId[0]);
        if (!$result) {
            throw new \RuntimeException("Не удалось удалить поле UF_COLOR");
        }
    }

    protected function includeHighloadModule()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }
    }

}