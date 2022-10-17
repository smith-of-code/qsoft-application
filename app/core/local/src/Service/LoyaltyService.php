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
use QSoft\Helper\UserGroupHelper;
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

    private const LOYALTY_LEVEL_K1 = 'K1';
    private const LOYALTY_LEVEL_K2 = 'K2';
    private const LOYALTY_LEVEL_K3 = 'K3';

    private const LOYALTY_LEVELS = [
        self::LOYALTY_LEVEL_K1 => [
            'label' => 'K1',
            'group' => UserGroupsService::USER_GROUP_CONSULTANT_1,
            'referral_size' => 100,
            'general_discount' => 7, // %
            'bonuses_by_personal_discount' => 2,
            'personal_bonuses_by_price' => [
                'size' => 1,
                'step' => 100,
            ],
            'group_bonuses_by_price' => [
                'size' => 1,
                'step' => 100,
            ],
        ],
        self::LOYALTY_LEVEL_K2 => [
            'label' => 'K2',
            'group' => UserGroupsService::USER_GROUP_CONSULTANT_2,
            'upgrade_size' => 100,
            'referral_size' => 150,
            'general_discount' => 10, // %
            'bonuses_by_personal_discount' => 2,
            'personal_bonuses_by_price' => [
                'size' => 2,
                'step' => 100,
            ],
            'group_bonuses_by_price' => [
                'size' => 2,
                'step' => 200,
            ],
        ],
        self::LOYALTY_LEVEL_K3 => [
            'label' => 'K3',
            'group' => UserGroupsService::USER_GROUP_CONSULTANT_3,
            'upgrade_size' => 300,
            'referral_size' => 200,
            'general_discount' => 12, // %
            'bonuses_by_personal_discount' => 2,
            'personal_bonuses_by_price' => [
                'size' => 3,
                'step' => 100,
            ],
            'group_bonuses_by_price' => [
                'size' => 4,
                'step' => 200,
            ],
        ],
    ];

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
     * @return string|null
     */
    public function getLoyaltyLevel() : ?string
    {
        if ($this->user->groups->isInAGroup($this->user->groups::USER_GROUP_CONSULTANT_3)) {
            return self::LOYALTY_LEVEL_K3;
        } elseif ($this->user->groups->isInAGroup($this->user->groups::USER_GROUP_CONSULTANT_2)) {
            return self::LOYALTY_LEVEL_K2;
        } elseif ($this->user->groups->isInAGroup($this->user->groups::USER_GROUP_CONSULTANT_1)) {
            return self::LOYALTY_LEVEL_K1;
        }
        return null;
    }

    /**
     * Получить коэффициенты и параметры текущего уровня программы лояльности
     * @return array|null
     */
    public function getLoyaltyLevelInfo() : ?array
    {
        return self::LOYALTY_LEVELS[$this->getLoyaltyLevel()] ?? null;
    }

    /**
     * Возвращает доту начала текущего квартала
     * @return DateTime|null
     */
    public function getQuarterStartDate() : ?DateTime
    {
        if (! isset($this->quarterStartDateTime)) {
            $this->quarterStartDateTime = DateTime::createFromTimestamp(Carbon::now()->startOfQuarter()->timestamp);
        }
        return $this->quarterStartDateTime;
    }

    /**
     * Возвращает доступный пользователю уровень лояльности согласно текущим условиям
     * @return string|null
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getAvailableLoyaltyLevel() : ?string
    {
        $availableLevel = self::LOYALTY_LEVEL_K1;

        //Получим необходимые данные по затратам
        $personalTotal = $this->user->orderAmount->getOrdersTotalSumForUser();
        $teamTotal = $this->user->orderAmount->getOrdersTotalSumForUserTeam();

        //Проверим возможность улучшения с уровня K1 на K2
        $personalTotalToUpgrade = app('config')->get('loyalty_level_terms.consultant.terms.1.upgrade.self');
        $teamTotalToUpgrade = app('config')->get('loyalty_level_terms.consultant.terms.1.upgrade.team');

        if (! isset($personalTotalToUpgrade) || ! isset($teamTotalToUpgrade)) {
            throw new RuntimeException('Config parameters not found');
        }
        if ($personalTotal >= $personalTotalToUpgrade && $teamTotal >= $teamTotalToUpgrade) {
            $availableLevel = self::LOYALTY_LEVEL_K2;
        }

        unset($personalTotalToUpgrade);
        unset($teamTotalToUpgrade);

        //Проверим возможность улучшения с уровня K2 на K3
        $personalTotalToUpgrade = app('config')->get('loyalty_level_terms.consultant.terms.2.upgrade.self');
        $teamTotalToUpgrade = app('config')->get('loyalty_level_terms.consultant.terms.2.upgrade.team');

        if (! isset($personalTotalToUpgrade) || ! isset($teamTotalToUpgrade)) {
            throw new RuntimeException('Config parameters not found');
        }
        if ($personalTotal >= $personalTotalToUpgrade && $teamTotal >= $teamTotalToUpgrade) {
            $availableLevel = self::LOYALTY_LEVEL_K3;
        }

        return $availableLevel;
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
        $availableLevel = $this->getAvailableLoyaltyLevel();

        if (! isset($availableLevel)) {
            return false;
        }

        if ($currentLevel !== $availableLevel) {
            // Удаляем пользователя из текущей группы
            $groups = UserGroupHelper::getAllUserGroups();
            UserGroupTable::delete([
                'GROUP_ID' => $groups[self::LOYALTY_LEVELS[$currentLevel]['group']],
                'USER_ID' => $this->user->id
            ]);
            // Устанавливаем пользователю соответствующий уровень в программе лояльности
            UserGroupTable::add([
                'GROUP_ID' => $groups[self::LOYALTY_LEVELS[$availableLevel]['group']],
                'USER_ID' => $this->user->id
            ]);
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
        return count(self::LOYALTY_LEVELS);
    }

    /**
     * Получить все уровни программы лояльности и информацию о них
     * @return array[]
     */
    static public function getLoyaltyLevels() : array
    {
        return self::LOYALTY_LEVELS;
    }
}