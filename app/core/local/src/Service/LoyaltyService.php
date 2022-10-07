<?php

namespace QSoft\Service;

use Bitrix\Catalog\Model\Price;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectNotFoundException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\UserGroupTable;
use Carbon\Carbon;
use CCatalogGroup;
use Exception;
use QSoft\Entity\User;
use QSoft\ORM\TransactionTable;
use RuntimeException;

/**
 * Класс для работы с программой лояльности
 * @package QSoft\Service
 */
class LoyaltyService
{
    /**
     * @var User Пользователь
     */
    private User $user;

    /**
     * @var DateTime Дата/время начала текущего квартала
     */
    private DateTime $quarterStartDateTime;

    /**
     * LoyaltyService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Получение текущего уровня в программе лояльности
     * @return int
     */
    public function getLoyaltyLevel() : int
    {
        if ($this->user->groups->isInAGroup($this->user->groups::USER_GROUP_CONSULTANT_3)) {
            return 3;
        } elseif ($this->user->groups->isInAGroup($this->user->groups::USER_GROUP_CONSULTANT_2)) {
            return 2;
        } elseif ($this->user->groups->isInAGroup($this->user->groups::USER_GROUP_CONSULTANT_1)) {
            return 1;
        }
        return 0;
    }

    /**
     * Получить коэффициенты и параметры уровня программы лояльности
     * @param int $level Уровень программы лояльности
     * @return array|null
     */
    public function getLoyaltyLevelInfo(int $level) : ?array
    {
        return app('config')->get('loyalty_level_terms.consultant.'.$level) ?? null;
    }

    /**
     * Возвращает доступный пользователю уровень лояльности согласно текущим условиям
     * @return int
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getAvailableLoyaltyLevelToUpgrade() : int
    {
        $availableLevel = 1;

        if ($this->checkIfCanUpgradeToLevel(3)) {
            $availableLevel = 3;
        } elseif ($this->checkIfCanUpgradeToLevel(2)) {
            $availableLevel = 2;
        }

        return $availableLevel;
    }

    /**
     * Проверяет возможность улучшения до конкретного уровня программы лояльности
     * @param int $level Уровень программы лояльности
     * @return bool
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function checkIfCanUpgradeToLevel(int $level) : bool
    {
        $levelInfo = $this->getLoyaltyLevelInfo($level);

        if (! isset($levelInfo)) {
            throw new RuntimeException('Config parameters not found');
        }

        //Получим необходимые данные по затратам
        $selfPeriodEnd = DateTimeService::getStartOfQuarter((intdiv($levelInfo['upgrade_level_terms']['self_period_months'], 3) - 1) * (-1));
        $teamPeriodEnd = DateTimeService::getStartOfQuarter((intdiv($levelInfo['upgrade_level_terms']['team_period_months'], 3) - 1) * (-1));
        $personalTotal = $this->user->orderAmount->getOrdersTotalSumForUser($selfPeriodEnd);
        $teamTotal = $this->user->orderAmount->getOrdersTotalSumForUserTeam($teamPeriodEnd);

        $personalTotalToUpgrade = (int) $levelInfo['upgrade_level_terms']['self_total'];
        $teamTotalToUpgrade = (int) $levelInfo['upgrade_level_terms']['team_total'];

        // Проверяем условия
        if ($personalTotal >= $personalTotalToUpgrade && $teamTotal >= $teamTotalToUpgrade) {
            return true;
        }

        return false;
    }


    /**
     * Обновляет уровень в программе лояльности для пользователя
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     * @throws Exception
     */
    public function changeLoyaltyLevel() : bool
    {
        // Получим текущий уровень пользователя
        $currentLevel = $this->getLoyaltyLevel();

        if (! isset($currentLevel)) {
            throw new RuntimeException('User is not participant of loyalty program');
        }

        // Получим доступный для перехода уровень
        $availableLevel = $this->getAvailableLoyaltyLevelToUpgrade();

        if ($currentLevel !== $availableLevel) {
            // Удаляем пользователя из текущей группы
            $groups = $this->user->groups->getAllUserGroups();
            $this->user->groups->removeFromGroup($groups[$this->getLoyaltyLevelInfo($currentLevel)['group']]);
            // Устанавливаем пользователю соответствующий уровень в программе лояльности
            $this->user->groups->addToGroup($groups[$this->getLoyaltyLevelInfo($availableLevel)['group']]);
            //TODO: Начисление баллов за переход
            return true;
        }
        return false;
    }

    /**
     * Количество уровней программы лояльности
     * @return int
     */
    static public function getAmountOfLevels() : int
    {
        return count(app('config')->get('loyalty_level_terms.consultant'));
    }

    /**
     * Получить все уровни программы лояльности и информацию о них
     * @return array[]
     */
    static public function getLoyaltyLevels() : array
    {
        return app('config')->get('loyalty_level_terms.consultant');
    }
}