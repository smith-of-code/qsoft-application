<?php

namespace QSoft\Helper;

use Bitrix\Main\Type\DateTime;
use Carbon\Carbon;
use Psr\Log\LogLevel;
use QSoft\Entity\User;
use QSoft\Logger\Logger;
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
            $error = new RuntimeException('Пользователь заблокирован - начисление бонусов невозможно');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }

        // Начисление баллов доступно только для Консультанта
        // (для Конечных покупателей балльная система не используется)
        if (! $user->groups->isConsultant()) {
            $error = new RuntimeException('Пользователь не является Консультантом');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
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
        if (! $user->groups->isConsultant()) {
            return false;
        }

        return $user->update([
            'UF_BONUS_POINTS' => $user->bonusPoints - $amount,
            'UF_LOYALTY_CHECK_DATE' => new DateTime,
        ]);
    }

    public function addOrderBonuses(User $user, int $orderId, int $amount, string $source, string $type): bool
    {
        if (!$user->active) {
            return false;
        }
        if (!$user->groups->isConsultant()) {
            return false;
        }

        $transactionResult = $this->transactions->add($user->id, $type, $source, TransactionTable::MEASURES['points'], $amount, $orderId);

        return $transactionResult->isSuccess() && $user->update([
            'UF_BONUS_POINTS' => $user->bonusPoints + $amount,
            'UF_LOYALTY_CHECK_DATE' => new DateTime,
        ]);
    }

    public function addOrderTransaction(User $user, int $orderId, float $amount, string $type, string $source): bool
    {
        if (!$user->active) {
            return false;
        }

        return $this->transactions->add($user->id, $type, $source, TransactionTable::MEASURES['money'], $amount, $orderId)->isSuccess();
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
            $error = new RuntimeException('Пользователь заблокирован - начисление бонусов невозможно');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }

        // Начисление баллов доступно только для Консультанта
        // (для Конечных покупателей балльная система не используется)
        if (! $user->groups->isConsultant()) {
            $error = new RuntimeException('Пользователь не является Консультантом');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }

        // Получаем количество баллов для начисления
        $amount = $this->consultantLoyalty->getUpgradeLevelBonus($user->loyaltyLevel);

        if ($this->bonusCantBeUpdate($user)) {
            return false;
        }

        if (isset($amount) && $amount) {
            // Добавляем транзакцию
            $this->transactions->add(
                $user->id,
                TransactionTable::TYPES["upgrade_to_$user->loyaltyLevel"],
                TransactionTable::SOURCES['personal'],
                TransactionTable::MEASURES['points'],
                $amount
            );

            $message = "Пользователю с id: {$user->id} начислено балов: {$amount}.";
            Logger::createFormatedLog(__CLASS__, LogLevel::INFO, $message);

            // Обновляем количество баллов пользователя
            return $user->update([
                'UF_BONUS_POINTS' => $user->bonusPoints + $amount
            ]);
        }
        return false;
    }

    private function bonusCantBeUpdate(User $user)
    {
        $lastTransaction = $this->transactions->getLatestTransactionLevelUp($user);
        $dateDiff = Carbon::now()->diffInMonths($lastTransaction);

        if ($user->loyaltyLevel === (new LoyaltyProgramHelper())->getHighestLevel() && ($dateDiff === 6)) {
            return true;
        }

        return false;
    }

    public function subtractOrderBonuses(User $user, int $amount): bool
    {
        if (!$user->active) {
            $error = new RuntimeException('Пользователь заблокирован - начисление бонусов невозможно');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }
        if (!$user->groups->isConsultant()) {
            $error = new RuntimeException('Пользователь не является Консультантом');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }
        if ($user->bonusPoints < $amount) {
            $error = new RuntimeException('У пользователя недостаточно бонусов');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
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
