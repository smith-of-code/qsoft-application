<?php

namespace QSoft\Service;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Entity;
use Bitrix\Main\Loader;
use Carbon\Carbon;
use QSoft\Entity\User;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\TransactionTable;

class OrderAmountService
{
    private User $user;

    /**
     * OrderAmountService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Возвращает сумму покупок пользователя за квартал
     * @return int суммарная стоимость в рублях
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getOrdersTotalSumForUser(): int
    {
        // Получаем личные транзакции пользователя за последний квартал
        $transactions = TransactionTable::getList([
            'select' => ['ID', 'UF_AMOUNT'],
            'filter' => [
                '=UF_USER_ID' => $this->user->id,
                '>=UF_CREATED_AT' => $this->user->loyalty->getQuarterStartDate(),
                '=UF_TYPE' => EnumDecorator::prepareField(TransactionTable::TYPES['purchase']),
                '=UF_SOURCE' => EnumDecorator::prepareField(TransactionTable::SOURCES['personal']),
                '=UF_MEASURE' => EnumDecorator::prepareField(TransactionTable::MEASURES['money'])
            ],
            'cache' => ['ttl' => 3600]
        ])->fetchAll();
        // Суммируем стоимость транзакций
        $total = 0;
        foreach ($transactions as $transaction) {
            $total += (int) $transaction['UF_AMOUNT'];
        }
        return $total;
    }

    /**
     * Возвращает сумму покупок команды пользователя за квартал
     * @return int суммарная стоимость в рублях
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getOrdersTotalSumForUserTeam(): int
    {
        // Получаем групповые транзакции пользователя за последний квартал
        $transactions = TransactionTable::getList([
            'select' => ['ID', 'UF_AMOUNT'],
            'filter' => [
                '=UF_USER_ID' => $this->user->id,
                '>=UF_CREATED_AT' => $this->user->loyalty->getQuarterStartDate(),
                '=UF_TYPE' => EnumDecorator::prepareField(TransactionTable::TYPES['purchase']),
                '=UF_SOURCE' => EnumDecorator::prepareField(TransactionTable::SOURCES['group']),
                '=UF_MEASURE' => EnumDecorator::prepareField(TransactionTable::MEASURES['money'])
            ],
            'cache' => ['ttl' => 3600]
        ])->fetchAll();
        // Суммируем стоимость транзакций
        $total = 0;
        foreach ($transactions as $transaction) {
            $total += (int) $transaction['UF_AMOUNT'];
        }
        return $total;
    }
}