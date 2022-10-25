<?php

namespace QSoft\Helper;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\DateTime;
use Exception;
use QSoft\Entity\User;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\TransactionTable;
use QSoft\Service\DateTimeService;
use RuntimeException;

/**
 * Класс для работы с программой лояльности
 * @package QSoft\Helper
 */
class LoyaltyProgramHelper
{
    const CONFIG_NAME = 'loyalty_level_terms';

    const LOYALTY_LEVEL_K1 = 'K1';
    const LOYALTY_LEVEL_K2 = 'K2';
    const LOYALTY_LEVEL_K3 = 'K3';

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
     * Возвращает конфигурацию уровней программы лояльности
     * @return mixed
     */
    static function getConfiguration() {
        return app('config')->get(self::CONFIG_NAME.'.consultant');
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
        return $levels[$level];
    }

    /**
     * Количество уровней программы лояльности
     * @return int
     */
    public function getAmountOfLevels() : int
    {
        $levels = $this->getLoyaltyLevels();
        return count($levels);
    }

    /**
     * Возвращает массив ID значений уровней программы лояльности (свойства пользователя)
     * @return array Массив пар "XML_ID" => "ID"
     */
    public function getLevelsIDs() : array
    {
        if (empty($this->levelsIDs)) {
            $this->levelsIDs = UserFieldHelper::getUserFieldEnumValuesIds('USER', 'UF_LOYALTY_LEVEL');
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

        if (! $user->groups->isConsultant()) {
            throw new RuntimeException('Пользователь не является Консультантом');
        }

        if (! isset($currentLevel) || $currentLevel === '') {
            throw new RuntimeException('Пользователь не является участником программы лояльности');
        }

        // Получим доступный для перехода уровень
        $availableLevel = $this->getAvailableLoyaltyLevelToUpgrade($user);

        if (isset($availableLevel)) {
            $levelsIDs = $this->getLevelsIDs();
            // Обновляем уровень
            if ($user->update(['UF_LOYALTY_LEVEL' => $levelsIDs[$availableLevel]])) {
                // Начисляем баллы за повышение уровня
                (new BonusAccountHelper())->addUpgradeLevelBonuses($user);
            }
            return true;
        }
        return false;
    }

    /**
     * Возвращает доступный пользователю уровень лояльности согласно текущим условиям
     * @param User $user Пользователь
     * @return string|null
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getAvailableLoyaltyLevelToUpgrade(User $user) : ?string
    {
        $availableLevel = null;

        if ($this->checkIfCanUpgradeToLevel($user, self::LOYALTY_LEVEL_K3)) {
            $availableLevel = self::LOYALTY_LEVEL_K3;
        } elseif ($this->checkIfCanUpgradeToLevel($user, self::LOYALTY_LEVEL_K2)) {
            $availableLevel = self::LOYALTY_LEVEL_K2;
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
            throw new RuntimeException('Config parameters not found');
        }
        // Если указанный уровень не выше текущего - улучшение невозможно
        if ((int) $levelInfo['level'] <= (int) $currentLevelInfo['level']) {
            return false;
        }

        // Получим необходимые данные по затратам
        $selfPeriodEnd = DateTimeService::getStartOfQuarter((intdiv($levelInfo['upgrade_level_terms']['self_period_months'], 3) - 1) * (-1));
        $teamPeriodEnd = DateTimeService::getStartOfQuarter((intdiv($levelInfo['upgrade_level_terms']['team_period_months'], 3) - 1) * (-1));
        $personalTotal = $user->orderAmount->getOrdersTotalSumForUser($selfPeriodEnd);
        $teamTotal = $user->orderAmount->getOrdersTotalSumForUserTeam($teamPeriodEnd);

        $personalTotalToUpgrade = (int) $levelInfo['upgrade_level_terms']['self_total'];
        $teamTotalToUpgrade = (int) $levelInfo['upgrade_level_terms']['team_total'];

        // Проверяем условия
        if ($personalTotal >= $personalTotalToUpgrade && $teamTotal >= $teamTotalToUpgrade) {
            return true;
        }
        return false;
    }

    public function getPersonalBonusesIncomeByPeriod(int $userId, DateTime $from, DateTime $to): float
    {
        $transactions = TransactionTable::getList([
            'filter' => [
                '=UF_USER_ID' => $userId,
                '=UF_SOURCE' => EnumDecorator::prepareField('UF_SOURCE', TransactionTable::SOURCES['personal']),
                '=UF_MEASURE' => EnumDecorator::prepareField('UF_MEASURE', TransactionTable::MEASURES['points']),
                [
                    'LOGIC' => 'AND',
                    ['>UF_CREATED_AT' => $from],
                    ['<UF_CREATED_AT' => $to],
                ],
            ],
            'select' => ['ID', 'UF_AMOUNT'],
        ])->fetchAll();

        return array_sum(array_column($transactions, 'UF_AMOUNT'));
    }

    public function getGroupBonusesIncomeByPeriod(int $userId, DateTime $from, DateTime $to): float
    {
        $transactions = TransactionTable::getList([
            'filter' => [
                '=UF_USER_ID' => $userId,
                '=UF_SOURCE' => EnumDecorator::prepareField('UF_SOURCE', TransactionTable::SOURCES['group']),
                '=UF_MEASURE' => EnumDecorator::prepareField('UF_MEASURE', TransactionTable::MEASURES['points']),
                [
                    'LOGIC' => 'AND',
                    ['>UF_CREATED_AT' => $from],
                    ['<UF_CREATED_AT' => $to],
                ],
            ],
            'select' => ['ID', 'UF_AMOUNT'],
        ])->fetchAll();

        return array_sum(array_column($transactions, 'UF_AMOUNT'));
    }

    /**
     * Получить количество баллов для начисления за приглашение Консультанта
     * @param $level
     * @return int|null
     */
    public function getReferralBonus($level) : ?int
    {
        $levels = $this->getLoyaltyLevels();
        return (int) $levels[$level]['benefits']['referral_size'] ?? null;
    }

    /**
     * Получить количество баллов для начисления за приглашение Консультанта
     * @param $level
     * @return int|null
     */
    public function getUpgradeLevelBonus($level) : ?int
    {
        $levels = $this->getLoyaltyLevels();
        return (int) $levels[$level]['benefits']['referral_size'] ?? null;
    }
}