<?php

use QSoft\Migrate\Traits\CreateEventTrait;
use QSoft\Migration\Migration;

class CreateChangeEmailEvent extends Migration
{
    use CreateEventTrait;

    private array $events = [
        [
            'event_type' => [
                'LID' => 'ru',
                'EVENT_NAME' => 'CHANGE_EMAIL',
                'NAME' => 'Подтверждение при смене email',
                'DESCRIPTION' => 'Подтверждение при смене email',
            ],
            'event_template' => [
                'ACTIVE' => 'Y',
                'LID' => SITE_ID,
                'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
                'EMAIL_TO' => '#EMAIL_TO#',
                'SUBJECT' => '#SITE_NAME#: Подтверждение смены email',
                'BODY_TYPE' => 'text',
                'MESSAGE' => 'Информационное сообщение сайта #SITE_NAME#
------------------------------------------

Здравствуйте,

Ваш код для подтверждения email: #CONFIRM_CODE#

---------------------------------------------------------------------

Сообщение сгенерировано автоматически.',
            ],
        ],
    ];

}