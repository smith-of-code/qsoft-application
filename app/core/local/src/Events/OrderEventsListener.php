<?php

namespace QSoft\Events;

use Bitrix\Sale\PropertyValue;
use QSoft\Entity\User;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\OrderHelper;
use QSoft\Notifiers\ChangeOrderNotifier;
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

        $notifier = new ChangeOrderNotifier($orderId, $status);
        $user->notification->sendNotification(
            $notifier->getTitle(),
            $notifier->getMessage(),
            $notifier->getLink()
        );

        switch ($status) {
            case OrderHelper::ACCOMPLISHED_STATUS:
                if ($user->bonusAccount->getTransactionByOrderId($orderId) != []) {
                    break;
                }

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

    public static function OnBeforeOrderUpdate(int $orderId, $fields): void
    {
        $order = Order::load($orderId);
        $user = new User($order->getUserId());

        if ($order->getField('STATUS_ID') == $fields['STATUS_ID']) {
            $notifier = new ChangeOrderNotifier($orderId, 'SAME');
            $user->notification->sendNotification(
                $notifier->getTitle(),
                $notifier->getMessage(),
                $notifier->getLink()
            );
        }
    }

    public static function OnBeforeOrderDelete(int $orderId): void
    {
        $order = Order::load($orderId);
        $user = new User($order->getUserId());

        $notifier = new ChangeOrderNotifier($orderId, 'DEL');
        $user->notification->sendNotification(
            $notifier->getTitle(),
            $notifier->getMessage(),
            $notifier->getLink()
        );

        $userData = $user->getPersonalData();
        $mailFields = [
            "MESSAGE_TAKER" => $userData['email'], // почта получателя
            "MESSAGE_TEXT" => $notifier->getMessage(), // текст уведомления
            "OWNER_NAME" => $userData['full_name'], // ФИО пользователя
            "TITLE" => $notifier->getTitle(), // Тема письма
        ];

        \CEvent::Send('NOTIFICATION_EVENT', 's1', $mailFields);
    }


    public static function OnOrderAdd ($id, &$arFields)
    {
        if (isset($arFields['USER_ID']) && (new User($arFields['USER_ID']))->groups->isBuyer()) {
            return;
        }
        
        $points = 0;
        foreach ($arFields['BASKET_ITEMS'] as $item) {
            $points += $item['PROPS']['BONUSES']['VALUE'];
        }

        // склонение слова.
        $pointName = self::wordDeclension($points, 'балл');

        if ($points !== 0) {
            $message = "Пользователю с ID {$arFields['USER_ID']} начисленно {$points} {$pointName} за заказ № {$id}";
            Logger::createFormatedLog(__CLASS__, LogLevel::INFO, $message);
        } else {
            $message = "Пользователю не начисленно баллов за заказ № {$id}";
            Logger::createFormatedLog(__CLASS__, LogLevel::INFO, $message);
        }

        $mailFields = ['ORDER_ID' => $orderId];
        \CEvent::Send('NEW_ORDER_FOR_ADMIN', 's1', $mailFields);
    }

    private static function wordDeclension(int $number, string$word)
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
