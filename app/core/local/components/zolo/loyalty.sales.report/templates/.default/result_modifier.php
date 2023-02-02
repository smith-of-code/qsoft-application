<?php

use Bitrix\Main\Type\Date;

$currentDate = new Date();

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

