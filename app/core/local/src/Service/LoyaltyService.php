<?php

namespace QSoft\Service;

use QSoft\Entity\User;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\LoyaltyProgramHelper;

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

        $levels = LoyaltyProgramHelper::getConfiguration();
        $bonusesHelper = new BonusAccountHelper();
        $loyaltyHelper = new LoyaltyProgramHelper();

        if ($this->user->loyaltyLevel !== '') {

            if ($this->user->groups->isConsultant()) {

                $nextLevel = $loyaltyHelper->getNextLevel($this->user->loyaltyLevel);

                // Достижения
                $result['CURRENT_LEVEL'] = $levels[$this->user->loyaltyLevel]['label'];
                $result['PERSONAL_DISCOUNT'] = $levels[$this->user->loyaltyLevel]['benefits']['personal_discount'];
                $result['CURRENT_AMOUNT_OF_BONUSES'] = $bonusesHelper->getTotalBonusesForCurrentQuarter($this->user);

                // Получим необходимые данные по затратам для удержания текущего уровня
                $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] = $levels[$this->user->loyaltyLevel]['hold_level_terms']['self_total'];
                $result['CURRENT_LEVEL_DETAILS']['TEAM_PURCHASES_LIMIT'] = $levels[$this->user->loyaltyLevel]['hold_level_terms']['team_total'];
                $selfPeriodEnd = DateTimeService::getStartOfQuarter((intdiv($levels[$this->user->loyaltyLevel]['hold_level_terms']['self_period_months'], 3) - 1) * (-1));
                $teamPeriodEnd = DateTimeService::getStartOfQuarter((intdiv($levels[$this->user->loyaltyLevel]['hold_level_terms']['team_period_months'], 3) - 1) * (-1));
                $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES'] = $this->user->orderAmount->getOrdersTotalSumForUser($selfPeriodEnd);
                $result['CURRENT_LEVEL_DETAILS']['TEAM_PURCHASES'] = $this->user->orderAmount->getOrdersTotalSumForUserTeam($teamPeriodEnd);
                $result['CURRENT_LEVEL_DETAILS']['BENEFITS'] = $levels[$this->user->loyaltyLevel]['benefits'];

                // Получим необходимые данные по затратам для повышения на следующий уровень
                if (isset($nextLevel)) {
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] = $levels[$this->user->loyaltyLevel]['upgrade_level_terms']['self_total'];
                    $result['UPGRADE_LEVEL_DETAILS']['TEAM_PURCHASES_LIMIT'] = $levels[$this->user->loyaltyLevel]['upgrade_level_terms']['team_total'];

                    $selfPeriodEnd = DateTimeService::getStartOfQuarter((intdiv($levels[$this->user->loyaltyLevel]['upgrade_level_terms']['self_period_months'], 3) - 1) * (-1));
                    $teamPeriodEnd = DateTimeService::getStartOfQuarter((intdiv($levels[$this->user->loyaltyLevel]['upgrade_level_terms']['team_period_months'], 3) - 1) * (-1));
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES'] = $this->user->orderAmount->getOrdersTotalSumForUser($selfPeriodEnd);
                    $result['UPGRADE_LEVEL_DETAILS']['TEAM_PURCHASES'] = $this->user->orderAmount->getOrdersTotalSumForUserTeam($teamPeriodEnd);
                    $result['UPGRADE_LEVEL_DETAILS']['BENEFITS'] = $levels[$nextLevel]['benefits'];
                }

            } elseif ($this->user->groups->isBuyer()) {

                $result['PERSONAL_DISCOUNT'] = $levels[$this->user->loyaltyLevel]['benefits']['personal_discount'];
            }
        }

        return $result;
    }
}