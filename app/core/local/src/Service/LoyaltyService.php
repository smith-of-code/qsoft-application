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
    public User $user;

    private const LOYALTY_LEVEL_K1 = 'K1';
    private const LOYALTY_LEVEL_K2 = 'K2';
    private const LOYALTY_LEVEL_K3 = 'K3';

    private const LOYALTY_LEVELS = [
        self::LOYALTY_LEVEL_K1 => [
            'label' => 'K1',
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