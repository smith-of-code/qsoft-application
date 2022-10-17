<?php

namespace QSoft\Helper;

use Bitrix\Main\Type\DateTime;
use QSoft\Entity\User;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\TransactionTable;
use QSoft\Service\DateTimeService;
use RuntimeException;

/**
 * Класс для работы с бонусным счетом пользователя
 * @package QSoft\Service
 */
class BonusAccountHelper
{
    private TransactionsHelper $transactions;
    private LoyaltyProgramHelper $loyalty;

    public function __construct()
    {
        $this->transactions = new TransactionsHelper();
        $this->loyalty = new LoyaltyProgramHelper();
    }

    /**
     * Начисляет баллы Консультанту за приглашение пользователя в рамках реферальной системы
     * @param User $user
     * @return bool
     */
    public function addReferralBonuses(User $user): bool
    {
        // Для отключенного аккаунта добавление баллов невозможно
        if (! $user->active) {
            throw new RuntimeException('Пользователь заблокирован - начисление бонусов невозможно');
        }

        // Начисление баллов доступно только для Консультанта
        if (! $user->groups->isConsultant()) {
            throw new RuntimeException('Пользователь не является Консультантом');
        }

        // Получаем количество баллов для начисления
        $amount = $this->loyalty->getReferralBonus($user->loyaltyLevel);

        if (isset($amount)) {
            // Добавляем транзакцию
            $this->transactions->add(
                $user->id,
                TransactionTable::TYPES['referral'],
                TransactionTable::SOURCES['personal'],
                TransactionTable::MEASURES['points'],
                $amount
            );

            // Обновляем количество баллов пользователя
            return $user->update([
                'UF_BONUS_POINTS' => $user->bonusPoints + $amount,
                'UF_LOYALTY_CHECK_DATE' => new DateTime,
            ]);
        }
        return false;
    }

    /**
     * Выполнить начисление бонусных баллов за повышение уровня
     * @param User $user
     * @return bool
     */
    public function addUpgradeLevelBonuses(User $user) : bool
    {
        // Для отключенного аккаунта добавление баллов невозможно
        if (! $user->active) {
            throw new RuntimeException('Пользователь заблокирован - начисление бонусов невозможно');
        }

        // Начисление баллов доступно только для Консультанта
        if (! $user->groups->isConsultant()) {
            throw new RuntimeException('Пользователь не является Консультантом');
        }

        // Получаем количество баллов для начисления
        $amount = $this->loyalty->getReferralBonus($user->loyaltyLevel);

        if (isset($amount)) {
            // Добавляем транзакцию
            $this->transactions->add(
                $user->id,
                TransactionTable::TYPES['upgrade'],
                TransactionTable::SOURCES['personal'],
                TransactionTable::MEASURES['points'],
                $amount
            );

            // Обновляем количество баллов пользователя
            return $user->update([
                'UF_BONUS_POINTS' => $user->bonusPoints + $amount,
                'UF_LOYALTY_CHECK_DATE' => new DateTime,
            ]);
        }
        return false;
    }

    /**
     * Получение транзакций с баллами за текущий квартал
     */
    public function getBonusesForCurrentQuarter(User $user)
    {
        $filter = [
            '=UF_USER_ID' => $user->id,
            '>=UF_CREATED_AT' => DateTimeService::CarbonToBitrixDateTime(DateTimeService::getStartOfQuarter(0)),
            '=UF_MEASURE' => EnumDecorator::prepareField(TransactionTable::MEASURES['points'])
        ];

        // Получаем транзакции пользователя за последний квартал
        return TransactionTable::getList([
            'select' => ['ID', 'UF_AMOUNT'],
            'filter' => $filter,
            'cache' => ['ttl' => 7776000] // кешируем на 3 месяца
        ])->fetchAll();
    }

    /**
     * Расчет количества накопленных баллов за текущий квартал
     * @param User $user
     * @return int Количество накопленных баллов
     */
    public function getTotalBonusesForCurrentQuarter(User $user) : int
    {
        $transactions = $this->getBonusesForCurrentQuarter($user);

        // Суммируем стоимость транзакций в баллах
        $total = 0;
        foreach ($transactions as $transaction) {
            if ((int) $transaction['UF_AMOUNT'] > 0) {
                $total += (int) $transaction['UF_AMOUNT'];
            }
        }
        return $total;
    }
}