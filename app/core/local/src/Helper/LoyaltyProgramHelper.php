<?php

namespace QSoft\Helper;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Exception;
use QSoft\Entity\User;
use QSoft\Service\DateTimeService;
use RuntimeException;

/**
 * Класс для работы с программой лояльности
 * @package QSoft\Helper
 */
class LoyaltyProgramHelper
{
    const CONFIG_NAME = 'loyalty_level_terms';

    // Уровни программы для Консультантов
    const LOYALTY_LEVELS_AMOUNT_K = 3; // Количество уровней
    const LOYALTY_LEVEL_K1 = 'K1';
    const LOYALTY_LEVEL_K2 = 'K2';
    const LOYALTY_LEVEL_K3 = 'K3';
    // Уровни программы для Конечных покупателей
    const LOYALTY_LEVELS_AMOUNT_B = 3; // Количество уровней
    const LOYALTY_LEVEL_B1 = 'B1';
    const LOYALTY_LEVEL_B2 = 'B2';
    const LOYALTY_LEVEL_B3 = 'B3';

    /**
     * @var array Массив ID значений свойства пользователя "Уровень в программе лояльности" ("XML_ID" => "ID")
     */
    private array $levelsIDs;
    /**
     * @var array Уровни программы лояльности и конфигурация каждого из них
     */
    private array $levels;

    public function __construct()
    {
        $this->levelsIDs = [];
        $this->levels = [];
    }

    /**
     * Проверяет, является ли строка уровнем в программе лояльности
     * @param string $level
     * @return bool
     */
    public function isLoyaltyLevel(string $level) : bool
    {
        $allLevels = [
            self::LOYALTY_LEVEL_K1,
            self::LOYALTY_LEVEL_K2,
            self::LOYALTY_LEVEL_K3,
            self::LOYALTY_LEVEL_B1,
            self::LOYALTY_LEVEL_B2,
            self::LOYALTY_LEVEL_B3,
        ];
        return in_array($level, $allLevels, true);
    }

    /**
     * Возвращает конфигурацию уровней программы лояльности
     * @return mixed
     */
    static function getConfiguration() {
        $consultantLevels = app('config')->get(self::CONFIG_NAME.'.consultant');
        $buyerLevels = app('config')->get(self::CONFIG_NAME.'.customer');
        return array_merge($consultantLevels, $buyerLevels);
    }

    /**
     * Получить все уровни программы лояльности и информацию о них
     * @return array[]
     */
    public function getLoyaltyLevels() : array
    {
        if (empty($this->levels)) {
            $this->levels = LoyaltyProgramHelper::getConfiguration();
        }
        return $this->levels;
    }

    /**
     * Получить коэффициенты и параметры уровня программы лояльности
     * @param string $level Уровень программы лояльности
     * @return array|null
     */
    public function getLoyaltyLevelInfo(string $level) : ?array
    {
        $levels = $this->getLoyaltyLevels();
        return $levels[$level] ?? null;
    }

    /**
     * Возвращает массив ID значений уровней программы лояльности (свойства пользователя)
     * @return array Массив пар "XML_ID" => "ID"
     */
    public function getLevelsIDs() : array
    {
        if (empty($this->levelsIDs)) {
            $consultantLevelsIDs = UserFieldHelper::getUserFieldEnumValuesIds('USER', 'UF_LOYALTY_LEVEL');
            $buyerLevelsIDs = UserFieldHelper::getUserFieldEnumValuesIds('USER', 'UF_PERSONAL_DISCOUNT_LEVEL');
            $this->levelsIDs = array_merge($consultantLevelsIDs, $buyerLevelsIDs);
        }
        return $this->levelsIDs;
    }

    /**
     * Проверяет возможность повышения уровня в программе лояльности для пользователя
     * и, по возможности, повышает уровень.
     * @param User $user Пользователь
     * @throws Exception
     */
    public function upgradeLoyaltyLevel(User $user) : bool
    {
        // Получим текущий уровень пользователя
        $currentLevel = $user->loyaltyLevel;

        if (! $this->isLoyaltyLevel($currentLevel)) {
            throw new RuntimeException('Пользователь не является участником программы лояльности');
        }

        // Получим доступный для перехода уровень
        $availableLevel = $this->getAvailableLoyaltyLevelToUpgrade($user);

        if (isset($availableLevel)) {
            $levelsIDs = $this->getLevelsIDs();
            if ($user->groups->isConsultant()) {
                // Обновляем уровень
                if ($user->update(['UF_LOYALTY_LEVEL' => $levelsIDs[$availableLevel]])) {
                    // Начисляем баллы за повышение уровня
                    $user->loyaltyLevel = $availableLevel;
                    (new BonusAccountHelper())->addUpgradeLevelBonuses($user);
                    return true;
                }
            } elseif ($user->groups->isBuyer()) {
                if ($user->update(['UF_PERSONAL_DISCOUNT_LEVEL' => $levelsIDs[$availableLevel]])) {
                    return true;
                }
            }
        }
        return false;
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
        if ($user->groups->isConsultant()) {

            $availableLevel = self::LOYALTY_LEVEL_K1;

            if ($this->checkIfCanUpgradeToLevel($user, self::LOYALTY_LEVEL_K3)) {
                $availableLevel = self::LOYALTY_LEVEL_K3;
            } elseif ($this->checkIfCanUpgradeToLevel($user, self::LOYALTY_LEVEL_K2)) {
                $availableLevel = self::LOYALTY_LEVEL_K2;
            }

            return $availableLevel;

        } elseif ($user->groups->isBuyer()) {

            $availableLevel = self::LOYALTY_LEVEL_B1;

            if ($this->checkIfCanUpgradeToLevel($user, self::LOYALTY_LEVEL_B3)) {
                $availableLevel = self::LOYALTY_LEVEL_B3;
            } elseif ($this->checkIfCanUpgradeToLevel($user, self::LOYALTY_LEVEL_B2)) {
                $availableLevel = self::LOYALTY_LEVEL_B2;
            }

            return $availableLevel;
        }
        return null;
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
            throw new RuntimeException('Не найдена информация об уровне программы лояльности');
        }
        // Если указанный уровень не выше текущего - улучшение невозможно
        if ((int) $levelInfo['level'] <= (int) $currentLevelInfo['level']) {
            return false;
        }

        if ($user->groups->isConsultant()) {
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
        } elseif ($user->groups->isBuyer()) {
            // Получим необходимые данные по затратам за прошедший месяц
            $selfPeriodStart = DateTimeService::getStartOfMonth(-1);
            $selfPeriodEnd = DateTimeService::getEndOfMonth(-1);
            $personalTotal = $user->orderAmount->getOrdersTotalSumForUser($selfPeriodStart, $selfPeriodEnd);

            $personalTotalToUpgrade = (int) $levelInfo['upgrade_level_terms']['self_total'];

            // Проверяем условия
            if ($personalTotal >= $personalTotalToUpgrade) {
                return true;
            }
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
        if ($this->isLoyaltyLevel($level)) {
            $levels = $this->getLoyaltyLevels();
            return (int) $levels[$level]['benefits']['personal_discount'] ?? 0;
        }
        return 0;
    }

    /**
     * Возвращает уровень, следующий за текущим (на который можно подняться)
     * @param string $level Уровень в системе лояльности
     * @return string|null Уровень в системе лояльности
     */
    public function getNextLevel(string $level) : ?string
    {
        // Проверка для уровней программы лояльности для Консультанта
        if ($level === self::LOYALTY_LEVEL_K1) {
            return self::LOYALTY_LEVEL_K2;
        } elseif ($level === self::LOYALTY_LEVEL_K2) {
            return self::LOYALTY_LEVEL_K3;
        }
        // Проверка для уровней программы лояльности для Конечного пользователя
        if ($level === self::LOYALTY_LEVEL_B1) {
            return self::LOYALTY_LEVEL_B2;
        } elseif ($level === self::LOYALTY_LEVEL_B2) {
            return self::LOYALTY_LEVEL_B3;
        }
        return null;
    }
}