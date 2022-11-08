<?php

namespace QSoft\Helper;

use Bitrix\Main\Loader;
use Bitrix\Main\Type\Date;
use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\OrderTable;
use QSoft\Entity\User;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\TransactionTable;

/**
 * Класс для работы с программой лояльности
 * @package QSoft\Helper
 */
class LoyaltyProgramHelper
{
    protected string $configPath = 'loyalty_level_terms';

    /**
     * @var array Массив ID значений свойства пользователя "Уровень в программе лояльности" ("XML_ID" => "ID")
     */
    protected array $levelsIDs;
    /**
     * @var array Уровни программы лояльности и конфигурация каждого из них
     */
    protected array $levels;

    public function __construct()
    {
        $this->levelsIDs = [];
        $this->levels = [];
        $this->includeModules();
    }

    private function includeModules(): void
    {
        Loader::includeModule('sale');
    }

    /**
     * Возвращает конфигурацию уровней программы лояльности
     * @return mixed
     */
    public function getConfiguration()
    {
        return app('config')->get($this->configPath);
    }

    public function getAccountingPeriod(Date $date): array
    {
        $currentQuarter = intdiv((int) $date->format('m') - 1, 3) + 1;
        $startPeriod = $currentQuarter + ($currentQuarter - 1) * 2;
        $endPeriod = $startPeriod + 2;

        return [
            'name' => numberToRoman($currentQuarter) . $date->format(' квартал Y'),
            'from' => new Date($date->format("01.$startPeriod.Y")),
            'to' => (new Date($date->format("01.$endPeriod.Y")))->add('+1 month')->add('-1 day'),
        ];
    }

    public function getCurrentAccountingPeriod(): array
    {
        return $this->getAccountingPeriod(new DateTime);
    }

    public function getAccountingPeriodsSinceDate(Date $date): array
    {
        $now = new Date;
        $period = $this->getAccountingPeriod($date);

        $result = [];
        while ($now->getDiff($period['to'])->invert) {
            $result[] = $period;
            $period = $this->getAccountingPeriod((new Date($period['to']))->add('+1 day'));
        }
        $result[] = $this->getCurrentAccountingPeriod();
        return array_reverse($result);
    }

    public function getAvailableAccountingPeriods(int $userId): array
    {
        return $this->getAccountingPeriodsSinceDate(new Date((new User($userId))->dateRegister));
    }

    /**
     * Получить все уровни программы лояльности и информацию о них
     * @return array[]
     */
    public function getLoyaltyLevels() : array
    {
        if (empty($this->levels)) {
            $this->levels = $this->getConfiguration();
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
        return $levels[$levels['types'][substr($level, 0, 1)]][$level] ?? null;
    }

    /**
     * Получить коэффициенты и параметры уровня программы лояльности
     * @param string $level Уровень программы лояльности
     * @return array|null
     */
    public function getNextLoyaltyLevelInfo(string $level) : ?array
    {
        $levels = $this->getLoyaltyLevels();
        return $levels[$levels['types'][substr($level, 0, 1)]][substr($level, 0, 1) . (substr($level, 1, 1) + 1)] ?? null;
    }

    /**
     * Возвращает массив ID значений уровней программы лояльности (свойства пользователя)
     * @return array Массив пар "XML_ID" => "ID"
     */
    public function getLevelsIDs() : array
    {
        if (empty($this->levelsIDs)) {
            $levelsNames = array_keys($this->getLoyaltyLevels());
            $IDs = UserFieldHelper::getUserFieldEnumValuesIds('USER', 'UF_LOYALTY_LEVEL');
            foreach ($levelsNames as $name) {
                $this->levelsIDs[$name] = $IDs[$name];
            }
        }
        return $this->levelsIDs;
    }

    /**
     * Получить самый низкий уровень программы лояльности
     * @return string XML_ID уровня
     */
    public function getLowestLevel(): ?string
    {
        $levels = $this->getLoyaltyLevels();
        $levelIndex = PHP_INT_MAX;
        $lowestLevel = null;
        foreach ($levels as $xmlId => $level) {
            if ($level['level'] < $levelIndex) {
                $levelIndex = $level['level'];
                $lowestLevel = $xmlId;
            }
        }
        return $lowestLevel;
    }

    public function getPersonalBonusesIncomeByPeriod(int $userId, Date $from, Date $to): array
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
            'select' => ['ID', 'UF_TYPE', 'UF_AMOUNT'],
        ])->fetchAll();

        $result = [];

        $typeFieldValues = HlBlockHelper::getEnumFieldValues(TransactionTable::getTableName(), 'UF_TYPE');
        $typeFieldMap = array_combine(array_column($typeFieldValues, 'ID'), array_column($typeFieldValues, 'XML_ID'));
        foreach ($transactions as $transaction) {
            $result[$typeFieldMap[$transaction['UF_TYPE']]] += (float)$transaction['UF_AMOUNT'];
        }

        return $result;
    }

    /**
     * Получить самый высокий уровень программы лояльности
     * @return string XML_ID уровня
     */
    public function getHighestLevel(): ?string
    {
        $levels = $this->getLoyaltyLevels();
        $levelIndex = -1;
        $highestLevel = null;
        foreach ($levels as $xmlId => $level) {
            if ($level['level'] > $levelIndex) {
                $levelIndex = $level['level'];
                $highestLevel = $xmlId;
            }
        }
        return $highestLevel;
    }

    public function getLoyaltyStatusByPeriod(int $userId, Date $from, Date $to): array
    {
        $user = new User($userId);
        $loyaltyLevelInfo = $this->getLoyaltyLevelInfo($user->loyaltyLevel);
        $nextLoyaltyLevelInfo = $this->getNextLoyaltyLevelInfo($user->loyaltyLevel);

        $result = [
            'self' => [
                'hold_value' => $loyaltyLevelInfo['hold_level_terms']['self_total'],
                'upgrade_value' => $nextLoyaltyLevelInfo ? $nextLoyaltyLevelInfo['upgrade_level_terms']['self_total'] : 0,
                'current_value' => .0,
            ],
            'team' => [
                'hold_value' => $loyaltyLevelInfo['hold_level_terms']['team_total'],
                'upgrade_value' => $nextLoyaltyLevelInfo ? $nextLoyaltyLevelInfo['upgrade_level_terms']['team_total'] : 0,
                'current_value' => .0,
            ],
        ];

        $transactions = TransactionTable::getList([
            'filter' => [
                '=UF_USER_ID' => $user->id,
                '=UF_MEASURE' => EnumDecorator::prepareField('UF_MEASURE', TransactionTable::MEASURES['money']),
                '!=UF_ORDER_ID' => null,
                [
                    'LOGIC' => 'AND',
                    ['>UF_CREATED_AT' => $from],
                    ['<UF_CREATED_AT' => $to],
                ],
            ],
            'select' => ['ID', 'UF_AMOUNT', 'UF_SOURCE'],
        ]);

        $groupSourceFieldId = EnumDecorator::prepareField('UF_SOURCE', TransactionTable::SOURCES['group']);
        foreach ($transactions as $transaction) {
            if ($transaction['UF_SOURCE'] === $groupSourceFieldId) {
                $result['team']['current_value'] += $transaction['UF_AMOUNT'];
            } else {
                $result['self']['current_value'] += $transaction['UF_AMOUNT'];
            }
        }

        return $result;
    }

    /**
     * Возвращает список XML_ID уровней, отсортированных в порядке возрастания
     * @return array Массив пар [index => XML_ID]
     */
    public function getSortedLevels() : array
    {
        $levels = $this->getLoyaltyLevels();
        $sortedLevels = [];
        foreach ($levels as $xmlId => $level) {
            $sortedLevels[(int) $level['level']] = $xmlId;
        }
        ksort($sortedLevels, SORT_NUMERIC);
        return $sortedLevels;
    }
}