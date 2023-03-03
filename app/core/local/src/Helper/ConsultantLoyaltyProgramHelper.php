<?php

namespace QSoft\Helper;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Exception;
use QSoft\Entity\User;
use QSoft\Notifiers\ConsultantUpgradeNotifier;
use QSoft\Service\DateTimeService;
use RuntimeException;
use Psr\Log\LogLevel;
use QSoft\Logger\Logger;

/**
 * Класс для работы с программой лояльности
 * @package QSoft\Helper
 */
class ConsultantLoyaltyProgramHelper extends LoyaltyProgramHelper
{
    public function __construct()
    {
        parent::__construct();
        $this->configPath .= '.consultant';
        $this->lowerLevel = $this->getLowestLevel();
    }

    /**
     * Проверяет возможность повышения уровня в программе лояльности для пользователя
     * и, по возможности, повышает уровень.
     * @param User $user Пользователь
     * @throws Exception
     */
    public function upgradeLoyaltyLevel(User $user) : bool
    {
        // Получим доступный для перехода уровень
        $availableLevel = $this->getAvailableLoyaltyLevelToUpgrade($user);

        if (isset($availableLevel)) {
            $levelsIDs = $this->getLevelsIDs();

            // Обновляем уровень
            if ($user->update(['UF_LOYALTY_LEVEL' => $levelsIDs[$availableLevel]])) {
                if (($user->loyaltyLevel != 'K2' && $availableLevel == 'K3')) {
                    $user->loyaltyLevel = 'K2';
                    (new BonusAccountHelper())->addUpgradeLevelBonuses($user);
                }

                if ($availableLevel != 'K3') {
                    (new BonusAccountHelper())->addUpgradeLevelBonuses($user);
                }

                if ($availableLevel == 'K3') {
                    (new BonusAccountHelper())->createHoldOnK3Transaction($user);
                }
                $user->loyaltyLevel = $availableLevel;

                // Отправляем уведомление с поздравлениями
                $fields = ['level' => $availableLevel];
                $notifier = new ConsultantUpgradeNotifier('LEVEL_UP', $fields);
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

                return true;
            }
        }

        if ((new BonusAccountHelper())->bonusCanBeUpdate($user)) {
            (new BonusAccountHelper())->addUpgradeLevelBonuses($user);
            return true;
        }

        return false;
    }

    /**
     * Проверяет условия повышения и поддержания уровня в программе лояльности для пользователя
     * @param User $user Пользователь
     * @throws Exception
     */
    public function checkUpgradeNotification(User $user): void
    {
        $period = $this->getCurrentAccountingPeriod();
        $loyaltyStatus = $this->getLoyaltyStatusByPeriod(
            $user->id,
            $period['from'],
            $period['to'],
        );

        $fields = [
            'to' => FormatDate('j F', $period['to']),
            'discount' => (new ConsultantLoyaltyProgramHelper)->getLoyaltyLevelInfo(
                $user->loyaltyLevel
            )['benefits']['personal_discount'],
        ];

        if ($loyaltyStatus['team']['upgrade_value'] < $loyaltyStatus['team']['current_value']) {
            $notification = 'SALES_PLAN';
        } elseif ($loyaltyStatus['self']['hold_value'] > $loyaltyStatus['self']['current_value']) {
            $shortage = $loyaltyStatus['self']['hold_value'] - $loyaltyStatus['self']['current_value'];
            $fields['shortage'] = $shortage . StringHelper::createWordForm($shortage, ' рубль', ' рубля', ' рублей');
            $notification = 'HOLD_PLAN';
        } elseif ($loyaltyStatus['self']['upgrade_value'] > $loyaltyStatus['self']['current_value']) {
            $shortage = $loyaltyStatus['self']['upgrade_value'] - $loyaltyStatus['self']['current_value'];
            $fields['shortage'] = $shortage . StringHelper::createWordForm($shortage, ' рубль', ' рубля', ' рублей');
            $notification = 'UPGRADE_PLAN';
        }

        if (isset($notification)) {
            $notifier = new ConsultantUpgradeNotifier($notification, $fields);
            $user->notification->sendNotification(
                $notifier->getTitle(),
                $notifier->getMessage(),
                $notifier->getLink()
            );
        }
    }

    /**
     * Возвращает доступный пользователю уровень лояльности с учетом текущих достижений в программе лояльности
     * @param User $user Пользователь
     * @return string|null
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getAvailableLoyaltyLevelToUpgrade(User $user) : ?string
    {
        $availableLevel = null;

        // Получаем информацию об уровнях
        $levels = $this->getLoyaltyLevels();
        // Получаем порядок уровней
        $sortedLevels = $this->getSortedLevels();
        // Получаем индекс текущего уровня (для определения позиции относительно остальных уровней)
        $currentLevelIndex = $levels[$user->loyaltyLevel]['level'];

        $lowerLevel = $this->lowerLevel;

        foreach ($sortedLevels as $index => $xmlId) {
            if ($xmlId == $user->loyaltyLevel) {
                $this->lowerLevel = $lowerLevel;
            }

            $lowerLevel = $xmlId;

            // Проверяем только вышестоящие уровни
            if ($index <= $currentLevelIndex) {
                continue;
            }

            if ($this->checkIfCanUpgradeToLevel($user, $xmlId)) {
                $availableLevel = $xmlId;
            }
        }

        if ($this->checkIfCantRetentionLevel($user, $user->loyaltyLevel)) {
            $availableLevel = $this->lowerLevel;
        }

        return $availableLevel;
    }

    /**
     * Проверяет возможность улучшения до конкретного уровня программы лояльности\
     * @param User $user Пользователь
     * @param string $level Уровень программы лояльности
     * @return bool
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function checkIfCanUpgradeToLevel(User $user, string $level) : bool
    {
        $currentLevelInfo = $this->getLoyaltyLevelInfo($user->loyaltyLevel);
        $levelInfo = $this->getLoyaltyLevelInfo($level);

        if (! isset($levelInfo) || ! isset($currentLevelInfo)) {
            $error = new RuntimeException('Не найдена информация об уровне программы лояльности');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        // Получим необходимые данные по затратам за прошедший квартал / два прошедших квартала
        $selfPeriodStart = DateTimeService::getStartOfQuarter(intdiv($levelInfo['upgrade_level_terms']['self_period_months'], 3) * (-1));
        $selfPeriodEnd = DateTimeService::getEndOfQuarter(-1);

        $teamPeriodStart = DateTimeService::getStartOfQuarter(intdiv($levelInfo['upgrade_level_terms']['team_period_months'], 3) * (-1));
        $teamPeriodEnd = DateTimeService::getEndOfQuarter(-1);

        $personalTotal = $user->orderAmount->getOrdersTotalSumForUser($selfPeriodStart, $selfPeriodEnd);
        $teamTotal = $user->orderAmount->getOrdersTotalSumForUserTeam($teamPeriodStart, $teamPeriodEnd);

        $personalTotalToUpgrade = (int) $levelInfo['upgrade_level_terms']['self_total'];
        $teamTotalToUpgrade = (int) $levelInfo['upgrade_level_terms']['team_total'];

        // Проверяем условия
        if ($personalTotal >= $personalTotalToUpgrade && $teamTotal >= $teamTotalToUpgrade) {
            return true;
        }

        return false;
    }

    /**
     * Проверяет возможность снижения до конкретного уровня программы лояльности
     * @param User $user Пользователь
     * @param string $level Уровень программы лояльности
     * @return bool
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function checkIfCantRetentionLevel(User $user, string $level) : bool
    {
        $currentLevelInfo = $this->getLoyaltyLevelInfo($user->loyaltyLevel, 'consultant');
        $levelInfo = $this->getLoyaltyLevelInfo($level, 'consultant');

        if (! isset($levelInfo) || ! isset($currentLevelInfo)) {
            $error = new RuntimeException('Не найдена информация об уровне программы лояльности');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        // Получим необходимые данные по затратам за прошедший квартал / два прошедших квартала
        $selfPeriodStart = DateTimeService::getStartOfQuarter(intdiv($levelInfo['hold_level_terms']['self_period_months'], 3) * (-1));
        $selfPeriodEnd = DateTimeService::getEndOfQuarter(-1);

        $teamPeriodStart = DateTimeService::getStartOfQuarter(intdiv($levelInfo['hold_level_terms']['team_period_months'], 3) * (-1));
        $teamPeriodEnd = DateTimeService::getEndOfQuarter(-1);

        $personalTotal = $user->orderAmount->getOrdersTotalSumForUser($selfPeriodStart, $selfPeriodEnd);
        $teamTotal = $user->orderAmount->getOrdersTotalSumForUserTeam($teamPeriodStart, $teamPeriodEnd);

        $personalTotalTRetention = (int) $levelInfo['hold_level_terms']['self_total'];
        $teamTotalToRetention = (int) $levelInfo['hold_level_terms']['team_total'];

        // Проверяем условия
        if ($personalTotal < $personalTotalTRetention && $teamTotal < $teamTotalToRetention) {
            return true;
        }

        return false;
    }

    /**
     * Получить количество баллов для начисления за приглашение Консультанта
     * @param string $level
     * @return int|null
     */
    public function getReferralBonus(string $level) : ?int
    {
        $levels = $this->getLoyaltyLevels();
        return (int) $levels[$level]['benefits']['referral_size'] ?? null;
    }

    /**
     * Получить количество баллов для начисления за переход на данный уровень
     * @param string $level Уровень в системе лояльности
     * @return int|null Количество баллов
     */
    public function getUpgradeLevelBonus(string $level) : ?int
    {
        $levels = $this->getLoyaltyLevels();
        return (int) $levels[$level]['benefits']['upgrade_level_bonuses'] ?? null;
    }

    /**
     * Получить величину персональной скидки Консультанта или Конечного покупателя
     * @param string $level Уровень в системе лояльности
     * @return int Величина скидки в процентах
     */
    public function getPersonalDiscount(string $level) : int
    {
        $levels = $this->getLoyaltyLevels();
        return (int) $levels[$level]['benefits']['personal_discount'] ?? 0;
    }
}
