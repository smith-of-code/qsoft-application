<?php

namespace QSoft\Service;

use Bitrix\Main\Type\DateTime;
use QSoft\Entity\User;
use QSoft\ORM\TransactionTable;
use RuntimeException;

/**
 * Класс для работы с бонусным счетом пользователя
 * @package QSoft\Service
 */
class BonusAccountService
{
    /**
     * @var User Пользователь
     */
    public User $user;

    /**
     * BonusAccountService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Начисляет баллы Консультанту за приглашение пользователя в рамках реферальной системы
     * @throws RuntimeException
     * @return bool
     */
    public function addReferralBonuses(): bool
    {
        // Для отключенного аккаунта добавление баллов невозможно
        if (! $this->user->active) {
            throw new RuntimeException('User not found');
        }

        // Начисление баллов доступно только для Консультанта
        if (! $this->user->groups->isConsultant()) {
            throw new RuntimeException('User is not consultant');
        }

        // Получаем количество баллов для начисления
        $loyaltyParams = $this->user->loyalty->getLoyaltyLevelInfo();
        $amount = $loyaltyParams['referral_size'];

        TransactionTable::add([
            'UF_USER_ID' => $this->user->id,
            'UF_TYPE' => TransactionTable::TYPES['referral'],
            'UF_SOURCE' => TransactionTable::SOURCES['personal'],
            'UF_MEASURE' => TransactionTable::MEASURES['points'],
            'UF_AMOUNT' => $amount,
        ]);

        return $this->user->update([
            'UF_BONUS_POINTS' => $this->user->bonusPoints + $amount,
            'UF_LOYALTY_CHECK_DATE' => new DateTime,
        ]);
    }
}