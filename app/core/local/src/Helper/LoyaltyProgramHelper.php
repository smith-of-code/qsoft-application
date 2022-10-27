<?php

namespace QSoft\Helper;

use Bitrix\Main\Type\DateTime;
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
    }

    /**
     * Возвращает конфигурацию уровней программы лояльности
     * @return mixed
     */
    public function getConfiguration()
    {
        return app('config')->get($this->configPath);
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
        return $levels[$level] ?? null;
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

    public function getLoyaltyStatusByPeriod(int $userId, DateTime $from, DateTime $to): array
    {
        $user = new User($userId);
        $loyaltyLevelInfo = $this->getLoyaltyLevelInfo($user->loyaltyLevel);

        $result = [
            'self' => [
                'hold_value' => $loyaltyLevelInfo['hold_level_terms']['self_total'],
                'upgrade_value' => $loyaltyLevelInfo['upgrade_level_terms']['self_total'],
                'current_value' => .0,
            ],
            'team' => [
                'hold_value' => $loyaltyLevelInfo['hold_level_terms']['team_total'],
                'upgrade_value' => $loyaltyLevelInfo['upgrade_level_terms']['self_total'],
                'current_value' => .0,
            ],
        ];

        $transactions = TransactionTable::getList([
            'filter' => [
                '=UF_USER_ID' => $userId,
                '=UF_MEASURE' => EnumDecorator::prepareField('UF_MEASURE', TransactionTable::MEASURES['points']),
                [
                    'LOGIC' => 'AND',
                    ['>UF_CREATED_AT' => $from],
                    ['<UF_CREATED_AT' => $to],
                ],
            ],
        ])->fetchAll();

        $sourceFieldSelfId = EnumDecorator::prepareField('UF_SOURCE', TransactionTable::SOURCES['personal']);
        foreach ($transactions as $transaction) {
            $result[$transaction['UF_SOURCE'] === $sourceFieldSelfId ? 'self' : 'team']['current_value'] += $transaction['UF_AMOUNT'];
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