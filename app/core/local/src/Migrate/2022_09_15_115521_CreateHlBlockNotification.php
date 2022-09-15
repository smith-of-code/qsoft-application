<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateHlBlockNotification extends BaseCreateHighloadMigration
{
    protected array $blockInfo = [
        'NAME'       => 'HlNotification',
        'TABLE_NAME' => 'notification',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок уведомлений',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_USER_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_USER_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Идентификатор пользователя'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Идентификатор пользователя'],
            'LIST_FILTER_LABEL' => ['ru' => 'Идентификатор пользователя'],
        ],
        [
            'FIELD_NAME' => 'UF_STATUS',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_STATUS',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Статус'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Статус'],
            'LIST_FILTER_LABEL' => ['ru' => 'Статус'],
        ],
        [
            'FIELD_NAME' => 'UF_TYPE',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_TYPE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Тип'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Тип'],
            'LIST_FILTER_LABEL' => ['ru' => 'Тип'],
        ],
        [
            'FIELD_NAME' => 'UF_MESSAGE',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_MESSAGE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Сообщение'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Сообщение'],
            'LIST_FILTER_LABEL' => ['ru' => 'Сообщение'],
        ],
        [
            'FIELD_NAME' => 'UF_LINK',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_LINK',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Ссылка'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Ссылка'],
            'LIST_FILTER_LABEL' => ['ru' => 'Ссылка'],
        ],
    ];

    protected array $enumValues = [
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
        'UF_STATUS' => [
            'n1' => [
                'XML_ID' => 'NOTIFICATION_STATUS_UNREAD',
                'VALUE' => 'не прочитано',
                'DEF' => 'Y',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'NOTIFICATION_STATUS_READ',
                'VALUE' => 'прочитано',
                'DEF' => 'N',
                'SORT' => 20,
            ],
        ],
    ];
}
