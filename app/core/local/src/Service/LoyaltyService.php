<?php

namespace QSoft\Service;

use QSoft\Entity\User;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\BuyerLoyaltyProgramHelper;
use QSoft\Helper\ConsultantLoyaltyProgramHelper;
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
     * LoyaltyService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Получение текущих показателей по программе лояльности
     */
    public function getLoyaltyProgramInfo()
    {
        $result = [];

        if ($this->user->groups->isConsultant()) {
            $loyaltyHelper = new ConsultantLoyaltyProgramHelper();
        } elseif ($this->user->groups->isBuyer()) {
            $loyaltyHelper = new BuyerLoyaltyProgramHelper();
        }

        if (!isset($loyaltyHelper)) {
            throw new RuntimeException('Пользователь не является участником программы лояльности');
        }

        $levels = $loyaltyHelper->getLoyaltyLevels();
        $bonusesHelper = new BonusAccountHelper();

        if ($this->user->loyaltyLevel !== '') {
            // Проверим, есть ли куда улучшать текущий уровень
            $upgradable = false;
            $sortedLevels = $loyaltyHelper->getSortedLevels();
            foreach ($sortedLevels as $index => $xmlId) {
                if ($xmlId === $this->user->loyaltyLevel) {
                    $nextLevel = next($sortedLevels);
                    break;
                }
                next($sortedLevels);
            }
            reset($sortedLevels);

            // Показатели для Консультантов
            if ($this->user->groups->isConsultant()) {

                // Достижения
                $result['CURRENT_LEVEL'] = $levels[$this->user->loyaltyLevel]['label'];
                $result['PERSONAL_DISCOUNT'] = $levels[$this->user->loyaltyLevel]['benefits']['personal_discount'];
                $result['PERSONAL_BONUSES_FOR_COST'] = $levels[$this->user->loyaltyLevel]['benefits']['personal_bonuses_for_cost'];
                $result['CURRENT_AMOUNT_OF_BONUSES'] = $bonusesHelper->getTotalBonusesForCurrentQuarter($this->user);

                // Получим необходимые данные по затратам для удержания текущего уровня
                $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] = $levels[$this->user->loyaltyLevel]['hold_level_terms']['self_total'];
                $selfPeriodStart = DateTimeService::getStartOfQuarter((intdiv($levels[$this->user->loyaltyLevel]['hold_level_terms']['self_period_months'], 3) - 1) * (-1));
                $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES'] = $this->user->orderAmount->getOrdersTotalSumForUser($selfPeriodStart);
                $left = $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] - $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES'];
                $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'] = $left > 0 ? $left : 0;

                // Получим необходимые данные по затратам для повышения на следующий уровень
                if (isset($nextLevel) && $nextLevel !== false) {
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] = $levels[$nextLevel]['upgrade_level_terms']['self_total'];
                    $selfPeriodStart = DateTimeService::getStartOfQuarter((intdiv($levels[$nextLevel]['upgrade_level_terms']['self_period_months'], 3) - 1) * (-1));
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES'] = $this->user->orderAmount->getOrdersTotalSumForUser($selfPeriodStart);
                    $left = $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] - $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES'];
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'] = $left > 0 ? $left : 0;
                }

            // Показатели для Конечных пользователей
            } elseif ($this->user->groups->isBuyer()) {

                $result['PERSONAL_DISCOUNT'] = $levels[$this->user->loyaltyLevel]['benefits']['personal_discount'];

                if (isset($nextLevel) && $nextLevel !== false) {
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] = $levels[$nextLevel]['upgrade_level_terms']['self_total'];
                    $selfPeriodStart = DateTimeService::getStartOfMonth(($levels[$nextLevel]['upgrade_level_terms']['self_period_months'] - 1) * (-1));
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES'] = $this->user->orderAmount->getOrdersTotalSumForUser($selfPeriodStart);
                    $left = $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] - $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES'];
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'] = $left > 0 ? $left : 0;
                }
            }
        }
        return $result;
    }

    public function calculateBonusesByPrice(float $price): int
    {
        if ($this->user->groups->isConsultant()) {
            $rules = $this->getLoyaltyProgramInfo()['PERSONAL_BONUSES_FOR_COST'];
            return intdiv($price, $rules['step']) * $rules['size'];
        }
        return 0;
    }
}