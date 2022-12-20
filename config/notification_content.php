<?php
/*
 * Типы уведомлений (ключи массива):
 * 'CHANGE_ORDER_STATUS',
 * 'UPDATE_SUPPORT_TICKET'
 *
 * Для отправки нового типа уведомлений:
 * - добавить новый тип уведомлений (ключ в массив с содержимым уведомлений для данного ключа).
 * - наследовать src/Notifiers/NotificationContent.php
 * - в методе getNotificationType() вернуть добавленный тип
 * - реализовать получение содержимого для уведомления в методах интерфейса src/Notifiers/Notifier.php
 * (использовать массив $this->notificationContent для доступа к данным)
 * */

return  [
    'CHANGE_ORDER_STATUS' => [
        'message' => 'Статус Вашего заказа был изменен. Информацию о заказе Вы можете узнать на детальной странице заказа.',
        'link_template' => '/personal/orders/#order_id#',
        'title_template' => 'Ваш заказ №#order_id# #status_name#'
    ],

    'UPDATE_SUPPORT_TICKET' => [
        'ACCEPTED' => [
            'CHANGE_OF_PERSONAL_DATA' => [
                'message' => 'Ваша заявка на смену персональных данных была рассмотрена и одобрена. Данные изменены.',
                'link_template' => '/personal/'
            ],
            'CHANGE_OF_LEGAL_ENTITY_DATA' => [
                'message' => 'Ваша заявка на смену юридических данных была рассмотрена и одобрена. Данные изменены.',
                'link_template' => '/personal/'
            ],
            'BECOME_CONSULTANT' => [
                'message' => 'Ваша заявка на смену роли была рассмотрена и одобрена. Данные изменены.',
                'link_template' => '/personal/'
            ],
            'REGISTRATION' => [
                'message' => 'Ваша заявка на регистрацию была рассмотрена была рассмотрена и одобрена.',
                'link_template' => '',
            ],
            'CHANGE_ROLE' => [
                'message' => 'Ваша заявка на изменение роли была рассмотрена и одобрена.',
                'link_template' => '',
            ],
            'SUPPORT' => [
                'Ваша заявка в техподдержку была рассмотрена и одобрена.',
                'link_template' => '',
            ]
        ],

        'REJECTED' => [
            'CHANGE_OF_PERSONAL_DATA' => [
                'message' => 'Ваша заявка на смену персональных данных была отклонена.',
                'link_template' => ''
            ],
            'CHANGE_OF_LEGAL_ENTITY_DATA' => [
                'message' => 'Ваша заявка на смену юридических данных была отклонена.',
                'link_template' => ''
            ],
            'BECOME_CONSULTANT' => [
                'message' => 'Ваша заявка на смену роли была отклонена.',
                'link_template' => ''
            ],
            'REGISTRATION' => [
                'message' => 'Ваша заявка на регистрацию была отклонена.',
                'link_template' => '',
            ],
            'CHANGE_ROLE' => [
                'message' => 'Ваша заявка на изменение роли была отклонена.',
                'link_template' => '',
            ],
            'SUPPORT' => [
                'Ваша заявка в техподдержку была отклонена.',
                'link_template' => '',
            ],
        ],

        'title' => 'Статус заявки изменился'
    ]
];
