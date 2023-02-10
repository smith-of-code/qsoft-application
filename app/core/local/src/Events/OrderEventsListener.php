<?php

namespace QSoft\Events;

use Bitrix\Sale\PropertyValue;
use QSoft\Entity\User;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\OrderHelper;
use QSoft\Notifiers\ChangeOrderStatusNotifier;
use Bitrix\Sale\Order;
use Psr\Log\LogLevel;
use QSoft\Logger\Logger;

class OrderEventsListener
{
    public static function OnSaleStatusOrder(int $orderId, string $status): void
    {
        $bonusAccountHelper = new BonusAccountHelper;

        $order = Order::load($orderId);
        $user = new User($order->getUserId());

        $notifier = new ChangeOrderStatusNotifier($orderId, $status);
        $user->notification->sendNotification(
            $notifier->getTitle(),
            $notifier->getMessage(),
            $notifier->getLink()
        );

        switch ($status) {
            case OrderHelper::ACCOMPLISHED_STATUS:
                $bonusesData = null;
                /** @var PropertyValue $property */
                foreach ($order->getPropertyCollection() as $property) {
                    if ($property->getField('CODE') === 'BONUSES_DATA') {
                        $bonusesData = json_decode($property->getField('VALUE'), true);
                        break;
                    }
                }
                if ($bonusesData) {
                    foreach ($bonusesData as $data) {
                        $tmpUser = new User($data['user_id']);
                        if ($user->groups->isConsultant()) {
                            $bonusAccountHelper->addOrderBonuses($tmpUser, $orderId, $data['value'], $data['source'], $data['type']);
                        }
                        $bonusAccountHelper->addOrderTransaction($tmpUser, $orderId, $order->getPrice(), $data['type'], $data['source']);
                    }
                }
                break;
            case OrderHelper::CANCELLED_STATUS:
            case OrderHelper::FULL_REFUNDED_STATUS:
            case OrderHelper::PARTLY_REFUNDED_STATUS:
                $bonuses = null;
                $bonusesAreReturned = null;
                /** @var PropertyValue $property */
                foreach ($order->getPropertyCollection() as $property) {
                    if ($property->getField('CODE') === 'BONUSES_ARE_RETURNED') {
                        $bonusesAreReturned = $property->getField('VALUE') === 'Y';
                        if (!$bonusesAreReturned) {
                            $property->setField('VALUE', 'Y');
                        }
                    } elseif ($property->getField('CODE') === 'POINTS') {
                        $bonuses = (int)$property->getField('VALUE');
                    }
                }

                if (!$bonusesAreReturned && $bonuses) {
                    $bonusAccountHelper->refundOrderBonuses($user, $bonuses);
                }
                break;
        }

        $order->save();
    }

    public static function OnOrderAdd ($id, &$arFields)
    {
        $points = 0;
        foreach ($arFields['BASKET_ITEMS'] as $item) {
            $points += $item['PROPS']['BONUSES']['VALUE'];
        }

        // склонение слова.
        $pointName = self::wordDeclension($points, 'балл');

        if ($points !== 0) {
            Logger::createLogger('orders', 0, LogLevel::INFO)
            ->setLog(
                "Пользователю с ID {$arFields['USER_ID']} начисленно {$points} {$pointName} за заказ № {$id}"
            );
        } else {
            Logger::createLogger('orders', 0, LogLevel::INFO)
            ->setLog(
                "Пользователю не начисленно баллов за заказ № {$id}"
            );
        }
    }

    private function wordDeclension(int $number, string$word)
    {
        if (!in_array($number, range(11, 19))) {
            if (substr($number, -1) == 2 || substr($number, -1) == 3 || substr($number, -1) == 4) {
                $ending = 'a';
            } elseif (substr($number, -1) == 1) {
                $ending = '';
            } else {
                $ending = 'oв';
            }
        }
        return $word . $ending;
    }
}
