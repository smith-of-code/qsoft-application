<?php

namespace QSoft\Service;

use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\Internals\DiscountTable;
use QSoft\Entity\User;

class UserDiscountsService
{
    private User $user;

    /**
     * UserGroupsService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Возвращает персональные акции пользователя
     * @return array
     */
    public function getUserPersonalDiscounts() : array
    {
        $result = [];
        // Запрашиваем активные правила корзины
        $discounts = DiscountTable::getList([
            'select' => ['ID', 'NAME', 'ACTIVE_FROM', 'ACTIVE_TO', 'CONDITIONS_LIST', 'ACTIONS_LIST'],
            'filter' => [
                '=ACTIVE' => 'Y',
                '<=ACTIVE_FROM' => new DateTime(),
                '>=ACTIVE_TO' => new DateTime(),
            ],
            'cache' => ['ttl' => 31536000],
        ]);
        while ($discount = $discounts->fetch()) {
            $isThisForCurrentUser = false;
            // Определим, относится ли пользователь к перечню пользователей, указанных в условии правила
            foreach ($discount['CONDITIONS_LIST']['CHILDREN'] as $condition) {
                if (
                    $condition['CLASS_ID'] === 'CondMainUserId'
                    && $condition['DATA']['logic'] === 'Equal'
                    && in_array($this->user->id, $condition['DATA']['value'])
                ) {
                    $isThisForCurrentUser = true;
                }
            }
            // Если правило относится к текущему пользователю и в действии - предоставление скидки
            // - сохраняем параметры правила корзины
            if (
                $isThisForCurrentUser
                && $discount['ACTIONS_LIST']['CHILDREN'][0]['CLASS_ID'] === 'ActSaleBsktGrp'
                && $discount['ACTIONS_LIST']['CHILDREN'][0]['DATA']['Type'] === 'Discount'
            ) {
                $result[$discount['ID']]['ID'] = $discount['ID'];
                $result[$discount['ID']]['NAME'] = $discount['NAME'];
                $result[$discount['ID']]['ACTIVE_TO'] = $discount['ACTIVE_TO'];
                $result[$discount['ID']]['DISCOUNT'] = $discount['ACTIONS_LIST']['CHILDREN'][0]['DATA']['Value'];
                if ($discount['ACTIONS_LIST']['CHILDREN'][0]['DATA']['Unit'] === 'Perc') {
                    $result[$discount['ID']]['UNITS'] = '%';
                } elseif ($discount['ACTIONS_LIST']['CHILDREN'][0]['DATA']['Unit'] === 'CurAll') {
                    $result[$discount['ID']]['UNITS'] = 'руб';
                }
            }
        }
        return $result;
    }
}