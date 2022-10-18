<?php

namespace QSoft\Service;

use Bitrix\Main\Type\DateTime;
use QSoft\Entity\User;
use QSoft\Helper\LoyaltyProgramHelper;
use QSoft\ORM\TransactionTable;
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
}