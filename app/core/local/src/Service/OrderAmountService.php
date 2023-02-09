<?php

namespace QSoft\Service;

use Carbon\Carbon;
use QSoft\Entity\User;
use QSoft\ORM\TransactionTable;
use QSoft\PropertiesDigest\Transactions;

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
     * Возвращает сумму покупок пользователя за указанный период времени
     * Если дата окончания периода не указана - будут учтены все записи, созданные до текущей даты
     * @param Carbon $startDateTime Дата начала периода времени
     * @param Carbon|null $endDateTime Дата окончания периода времени
     * @return int суммарная стоимость в рублях
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getOrdersTotalSumForUser(Carbon $startDateTime, Carbon $endDateTime = null): int
    {
        $sourseList = TransactionTable::getFieldListIds('UF_SOURCE');
        $measureList = TransactionTable::getFieldListIds('UF_MEASURE');

        $filter = [
            '=UF_USER_ID' => $this->user->id,
            '>=UF_CREATED_AT' => DateTimeService::CarbonToBitrixDateTime($startDateTime),
            '=UF_SOURCE' => $sourseList[Transactions::SOURCE_PERSONAL],
            '=UF_MEASURE' => $measureList[Transactions::MEASURE_MONEY]
        ];

        // Если есть дата окончания - добавляем в фильтр
        if (isset($endDateTime)) {
            $filter['<UF_CREATED_AT'] = DateTimeService::CarbonToBitrixDateTime($endDateTime);
        }

        // Получаем личные транзакции пользователя за последний квартал
        $transactions = TransactionTable::getList([
            'select' => ['ID', 'UF_AMOUNT'],
            'filter' => $filter,
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
     * Возвращает сумму покупок команды пользователя за указанный период времени
     * Если дата окончания периода не указана - будут учтены все записи, созданные до текущей даты
     * @param Carbon $startDateTime Дата начала периода времени
     * @param Carbon|null $endDateTime Дата окончания периода времени
     * @return int суммарная стоимость в рублях
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getOrdersTotalSumForUserTeam(Carbon $startDateTime, Carbon $endDateTime = null): int
    {
        $sourseList = TransactionTable::getFieldListIds('UF_SOURCE');
        $measureList = TransactionTable::getFieldListIds('UF_MEASURE');

        $filter = [
            '=UF_USER_ID' => $this->user->id,
            '>=UF_CREATED_AT' => DateTimeService::CarbonToBitrixDateTime($startDateTime),
            '=UF_SOURCE' => $sourseList[Transactions::SOURCE_GROUP],
            '=UF_MEASURE' => $measureList[Transactions::MEASURE_MONEY]
        ];

        // Если есть дата окончания - добавляем в фильтр
        if (isset($endDateTime)) {
            $filter['<UF_CREATED_AT'] = DateTimeService::CarbonToBitrixDateTime($endDateTime);
        }

        // Получаем групповые транзакции пользователя за последний квартал
        $transactions = TransactionTable::getList([
            'select' => ['ID', 'UF_AMOUNT'],
            'filter' => $filter,
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
