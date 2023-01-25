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
        'NEW' => [
            'CHANGE_OF_PERSONAL_DATA' => [
                'message' => 'Заявка на смену данных №#app_id# на рассмотрении.',
                'title_template' => 'Новая заявка'
            ],
            'BECOME_CONSULTANT' => [
                'message' => 'Заявка №#app_id# "Стать Консультантом" находится на рассмотрении до #date#.',
                'title_template' => 'Новая заявка'
            ],
            'CHANGE_MENTOR' => [
                'message' => 'Заявка на смену Наставника №#app_id# на рассмотрении. ',
                'title_template' => 'Новая заявка'
            ],
        ],

        'ACCEPTED' => [
            'CHANGE_OF_PERSONAL_DATA' => [
                'message' => 'Ваши данные успешно изменены.',
                'link_template' => '/personal/'
            ],
            'CHANGE_OF_LEGAL_ENTITY_DATA' => [
                'message' => 'Ваша заявка на смену юридических данных была рассмотрена и одобрена. Данные изменены.',
                'link_template' => '/personal/'
            ],
            'BECOME_CONSULTANT' => [
                'message' => 'Заявка №#app_id# "Стать Консультантом" одобрена. Поздравляем! Теперь Вы Консультант AmeAppetite!',
                'link_template' => '/personal/'
            ],
            'CHANGE_MENTOR' => [
                'message' => 'У Вас новый Наставник: #FIO#, #phone#',
                'link_template' => '/personal/',
            ],
            'CHANGE_MENTOR_FOR_BUYERS' => [
                'message' => 'Обратите внимание, у Вашего Наставника новый номер телефона: #phone#, электронный адрес #email#, город проживания #city#',
                'title_template' => 'Смена данных наставника',
                'link_template' => '/personal/',
            ],
            'REGISTRATION' => [
                'message' => 'Ваша заявка на регистрацию была рассмотрена была рассмотрена и одобрена.',
            ],
            'CHANGE_ROLE' => [
                'message' => 'Ваша заявка на изменение роли была рассмотрена и одобрена.',
            ],
            'SUPPORT' => [
                'Ваша заявка в техподдержку была рассмотрена и одобрена.',
            ]
        ],

        'REJECTED' => [
            'CHANGE_OF_PERSONAL_DATA' => [
                'message' => 'Заявка на смену данных №#app_id# отклонена. Для уточнения деталей свяжитесь со службой поддержки.',
            ],
            'CHANGE_OF_LEGAL_ENTITY_DATA' => [
                'message' => 'Ваша заявка на смену юридических данных была отклонена.',
            ],
            'BECOME_CONSULTANT' => [
                'message' => 'Заявка №#app_id# "Стать Консультантом" отклонена. Для уточнения деталей свяжитесь со службой поддержки.',
            ],
            'CHANGE_MENTOR' => [
                'message' => 'Заявка на смену Наставника №#app_id# отклонена. Для уточнения деталей свяжитесь со службой поддержки.',
            ],
            'REGISTRATION' => [
                'message' => 'Ваша заявка на регистрацию была отклонена.',
            ],
            'CHANGE_ROLE' => [
                'message' => 'Ваша заявка на изменение роли была отклонена.',
            ],
            'SUPPORT' => [
                'message' => 'Ваша заявка в техподдержку была отклонена.',
            ],
        ],

        'title' => 'Статус заявки изменился',
        'link' => '/notifications/'
    ]
];
