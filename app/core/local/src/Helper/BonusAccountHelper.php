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
    private ConsultantLoyaltyProgramHelper $consultantLoyalty;
    private BuyerLoyaltyProgramHelper $buyerLoyalty;

    public function __construct()
    {
        $this->transactions = new TransactionsHelper();
        $this->consultantLoyalty = new ConsultantLoyaltyProgramHelper();
        $this->buyerLoyalty = new BuyerLoyaltyProgramHelper();
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
        // (для Конечных покупателей балльная система не используется)
        if (! $user->groups->isConsultant()) {
            throw new RuntimeException('Пользователь не является Консультантом');
        }

        // Получаем количество баллов для начисления
        $amount = $this->consultantLoyalty->getReferralBonus($user->loyaltyLevel);

        if (isset($amount)) {
            // Добавляем транзакцию
            $result = $this->transactions->add(
                $user->id,
                TransactionTable::TYPES['referral'],
                TransactionTable::SOURCES['personal'],
                TransactionTable::MEASURES['points'],
                $amount
            );

            if ($result->isSuccess()) {
                // Обновляем количество баллов пользователя
                return $user->update([
                    'UF_BONUS_POINTS' => $user->bonusPoints + $amount
                ]);
            }
            return false;
        }
        return false;
    }

    public function refundOrderBonuses(User $user, float $amount): bool
    {
        if (!$user->active) {
            throw new RuntimeException('Пользователь заблокирован - начисление бонусов невозможно');
        }
        if (!$user->groups->isConsultant()) {
            throw new RuntimeException('Пользователь не является Консультантом');
        }

        return $user->update([
            'UF_BONUS_POINTS' => $user->bonusPoints + $amount,
            'UF_LOYALTY_CHECK_DATE' => new DateTime,
        ]);
    }

    public function addOrderBonuses(User $user, float $amount, string $source = TransactionTable::SOURCES['personal']): bool
    {
        if (!$user->active) {
            throw new RuntimeException('Пользователь заблокирован - начисление бонусов невозможно');
        }
        if (!$user->groups->isConsultant()) {
            throw new RuntimeException('Пользователь не является Консультантом');
        }

        $this->transactions->add(
            $user->id,
            TransactionTable::TYPES['purchase'],
            $source,
            TransactionTable::MEASURES['points'],
            $amount,
        );

        return $user->update([
            'UF_BONUS_POINTS' => $user->bonusPoints + $amount,
            'UF_LOYALTY_CHECK_DATE' => new DateTime,
        ]);
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
        // (для Конечных покупателей балльная система не используется)
        if (! $user->groups->isConsultant()) {
            throw new RuntimeException('Пользователь не является Консультантом');
        }

        // Получаем количество баллов для начисления
        $amount = $this->consultantLoyalty->getReferralBonus($user->loyaltyLevel);

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
                'UF_BONUS_POINTS' => $user->bonusPoints + $amount
            ]);
        }
        return false;
    }

    public function subtractOrderBonuses(User $user, float $amount): bool
    {
        if (!$user->active) {
            throw new RuntimeException('Пользователь заблокирован - начисление бонусов невозможно');
        }
        if (!$user->groups->isConsultant()) {
            throw new RuntimeException('Пользователь не является Консультантом');
        }
        if ($user->bonusPoints < $amount) {
            throw new RuntimeException('У пользователя недостаточно бонусов');
        }

        return $user->update([
            'UF_BONUS_POINTS' => $user->bonusPoints - $amount,
            'UF_LOYALTY_CHECK_DATE' => new DateTime,
        ]);
    }

    /**
     * Получение транзакций с баллами за текущий квартал
     */
    public function getBonusesTransactionsForCurrentQuarter(User $user)
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
            'cache' => ['ttl' => 604800] // кешируем на 1 неделю
        ])->fetchAll();
    }

    /**
     * Расчет количества накопленных баллов за текущий квартал
     * @param User $user
     * @return int Количество накопленных баллов
     */
    public function getTotalBonusesForCurrentQuarter(User $user) : int
    {
        $transactions = $this->getBonusesTransactionsForCurrentQuarter($user);

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