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
class BuyerLoyaltyProgramHelper extends LoyaltyProgramHelper
{
    public function __construct()
    {
        parent::__construct();
        $this->configPath .= '.customer';
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
            if ($user->update(['UF_PERSONAL_DISCOUNT_LEVEL' => $levelsIDs[$availableLevel]])) {
                $user->loyaltyLevel = $availableLevel;
                return true;
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
        $availableLevel = null;

        // Получаем информацию об уровнях
        $levels = $this->getLoyaltyLevels();
        // Получаем порядок уровней
        $sortedLevels = $this->getSortedLevels();
        // Получаем индекс текущего уровня (для определения позиции относительно остальных уровней)
        $currentLevelIndex = $levels[$user->loyaltyLevel]['level'];

        foreach ($sortedLevels as $index => $xmlId) {
            // Проверяем только вышестоящие уровни
            if ($index <= $currentLevelIndex) {
                continue;
            }
            if ($this->checkIfCanUpgradeToLevel($user, $xmlId)) {
                $availableLevel = $xmlId;
            }
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
            throw new RuntimeException('Не найдена информация об уровне программы лояльности');
        }

        // Получим необходимые данные по затратам за прошедший месяц
        $selfPeriodStart = DateTimeService::getStartOfMonth(-1);
        $selfPeriodEnd = DateTimeService::getEndOfMonth(-1);
        $personalTotal = $user->orderAmount->getOrdersTotalSumForUser($selfPeriodStart, $selfPeriodEnd);

        $personalTotalToUpgrade = (int) $levelInfo['upgrade_level_terms']['self_total'];

        // Проверяем условия
        if ($personalTotal >= $personalTotalToUpgrade) {
            return true;
        }

        return false;
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