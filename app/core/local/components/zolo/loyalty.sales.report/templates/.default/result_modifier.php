<?php

use Bitrix\Main\Type\Date;

dump($arResult['user_team']);
$currentDate = new Date();
$date = new Date('25.12.2015 12:30:00');

$diff = (new Date($currentDate))->getDiff($date);

dump($currentDate, $date, $diff->days);

foreach ($arResult['user_team'] as &$team) {
    foreach ($team as &$user) {
        if ($user['orders_report']['self']['last_order_date']) {
            $isToLongTimeNoBy
                = (
                    new Date($currentDate))
                    ->getDiff($user['orders_report']['self']['last_order_date']
                )->days > 30;

            if ($isToLongTimeNoBy) {
                $user['orders_report']['self']['last_order_date'] = 'Пользователь стал менее активным';
            }
        }

        unset($user);
    }

    unset($team);
}

