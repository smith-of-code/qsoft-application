<?php

use QSoft\Migrate\Traits\UpdateEventMessagesTrait;
use QSoft\Migration\Migration;

class UpdateEmailEvents extends Migration
{
    use UpdateEventMessagesTrait;

    private array $eventMessages = [
        [
            'event_name' => 'USER_PASS_REQUEST',
            'from' => [
                'MESSAGE' => 'Информационное сообщение сайта #SITE_NAME#
------------------------------------------
#NAME# #LAST_NAME#,

#MESSAGE#

Для смены пароля перейдите по следующей ссылке:
http://#SERVER_NAME#/auth/index.php?change_password=yes&lang=ru&USER_CHECKWORD=#CHECKWORD#&USER_LOGIN=#URL_LOGIN#

Ваша регистрационная информация:

ID пользователя: #USER_ID#
Статус профиля: #STATUS#
Login: #LOGIN#

Сообщение сгенерировано автоматически.',
            ],
            'to' => [
                'MESSAGE' => 'Информационное сообщение сайта #SITE_NAME#
------------------------------------------
#NAME# #LAST_NAME#,

#MESSAGE#

Для смены пароля перейдите по следующей ссылке:
http://#SERVER_NAME#/login?change_password=yes&lang=ru&user_id=#USER_ID#&confirm_code=#CONFIRM_CODE#

Ваша регистрационная информация:

ID пользователя: #USER_ID#
Статус профиля: #STATUS#
Login: #LOGIN#

Сообщение сгенерировано автоматически.',
            ],
        ],
    ];
}