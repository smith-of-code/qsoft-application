<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 19:41
 * Удаление поля: UF_TYPE (тип: список)
 * Добавление полей: UF_TITLE, UF_DATE_TIME
 */

use Bitrix\Highloadblock\HighloadBlockTable;
use QSoft\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Bitrix\Main\Loader;

class ChangeFieldsHlBlockNotification extends Migration {

    private $upAddFields = [
        [
            'FIELD_NAME' => 'UF_TITLE',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_TITLE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Заголовок'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Заголовок'],
            'LIST_FILTER_LABEL' => ['ru' => 'Заголовок'],
            'SETTINGS' => [
                'SIZE' => 20,
                'ROWS' => 1,
                'REGEXP' => '',
                'MIN_LENGTH' => 0,
                'MAX_LENGTH' => 0,
            ],
        ],
        [
            'FIELD_NAME' => 'UF_DATE_TIME',
            'USER_TYPE_ID' => 'datetime',
            'XML_ID' => 'UF_DATE_TIME',
            'SORT' => 100,
            'MANDATORY' => 'Y',
            'EDIT_FORM_LABEL' => ['ru' => 'Дата со временем'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Дата со временем'],
            'LIST_FILTER_LABEL' => ['ru' => 'Дата со временем'],
            'SETTINGS' => [
                'DEFAULT_VALUE' => ['TYPE' => 'NOW', 'VALUE' => '',],
                'USE_SECOND' => 'Y',
                'USE_TIMEZONE' => 'N',
            ],
        ],
    ];
    private $upDeleteFields = ['UF_TYPE'];

    private $downAddFields = [
        [
            'FIELD_NAME' => 'UF_TYPE',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_TYPE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Тип'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Тип'],
            'LIST_FILTER_LABEL' => ['ru' => 'Тип'],
        ],
    ];

    private $downAddEnumValues = [
        'UF_TYPE' => [
            'n1' => [
                'XML_ID' => 'NOTIFICATION_TYPE_APPLICATION_STATUS_CHANGE',
                'VALUE' => 'изменение статуса заявки',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'NOTIFICATION_TYPE_ORDER_CREATED',
                'VALUE' => 'создание заказа',
                'DEF' => 'N',
                'SORT' => 20,
            ],
            'n3' => [
                'XML_ID' => 'NOTIFICATION_TYPE_ORDER_STATUS_CHANGE',
                'VALUE' => 'изменение статуса заказа',
                'DEF' => 'N',
                'SORT' => 30,
            ],
            'n4' => [
                'XML_ID' => 'NOTIFICATION_TYPE_ORDER_READY',
                'VALUE' => 'заказ готов',
                'DEF' => 'N',
                'SORT' => 40,
            ],
            'n5' => [
                'XML_ID' => 'NOTIFICATION_TYPE_ORDER_CANCELED',
                'VALUE' => 'отмена заказа',
                'DEF' => 'N',
                'SORT' => 50,
            ],
        ],
    ];

    private $downDeleteFields = ['UF_TITLE', 'UF_DATE_TIME'];

    private int $hlBlockId;

    public function __construct() {

        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }

        $this->hlBlockId = HighloadBlockTable::getRow(['filter' => ['TABLE_NAME' => 'notification']])['ID'];

        if (! $this->hlBlockId) {
            throw new RuntimeException('Не найден HL-блок "HlNotification"');
        }
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $entityManager = new \CUserTypeEntity();

        foreach ($this->upAddFields as $field) {
            $fieldId = $entityManager->Add(['ENTITY_ID' => "HLBLOCK_" . $this->hlBlockId['ID']] + $field);
            if (!$fieldId) {
                throw new \RuntimeException("Не удалось добавить поле {$field['FIELD_NAME']}");
            }
        }

        foreach ($this->upDeleteFields as $field) {
            $deleteId = $entityManager->GetList(
                [],
                [
                    'ENTITY_ID' => 'HLBLOCK_' . $this->hlBlockId['ID'],
                    'FIELD_NAME' => $field,
                ]
            )->Fetch()['ID'];

            if (! $entityManager->Delete($deleteId)) {
                throw new RuntimeException("Не удалось удалить поле {$field}");
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $entityManager = new \CUserTypeEntity();
        $enumManager = new \CUserFieldEnum();

        foreach ($this->downAddFields as $field) {

            $fieldId = $entityManager->Add(['ENTITY_ID' => "HLBLOCK_" . $this->hlBlockId['ID']] + $field);
            if (! $fieldId) {
                throw new \RuntimeException("Не удалось добавить поле {$field['FIELD_NAME']}");
            }

            $enumManager->SetEnumValues($fieldId, $this->downAddEnumValues[$field['FIELD_NAME']]);
        }

        foreach ($this->downDeleteFields as $field) {
            $removingId = $entityManager->GetList(
                [],
                [
                    'ENTITY_ID' => 'HLBLOCK_' . $this->hlBlockId['ID'],
                    'FIELD_NAME' => $field,
                ]
            )->Fetch()['ID'];

            if (! $entityManager->Delete($removingId)) {
                throw new RuntimeException("Не удалось удалить поле {$field}");
            }
        }
    }
}
