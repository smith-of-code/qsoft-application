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
            // Получим следующий уровень - проверим, есть ли куда улучшать текущий
            $nextLevel = $loyaltyHelper->getNextLevel($this->user->loyaltyLevel);

            // Показатели для Консультантов
            if ($this->user->groups->isConsultant()) {

                // Достижения
                $result['CURRENT_LEVEL'] = $levels[$this->user->loyaltyLevel]['label'];
                $result['PERSONAL_DISCOUNT'] = $levels[$this->user->loyaltyLevel]['benefits']['personal_discount'];
                $result['CURRENT_AMOUNT_OF_BONUSES'] = $bonusesHelper->getTotalBonusesForCurrentQuarter($this->user);

                // Получим необходимые данные по затратам для удержания текущего уровня
                $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] = $levels[$this->user->loyaltyLevel]['hold_level_terms']['self_total'];
                $selfPeriodStart = DateTimeService::getStartOfQuarter((intdiv($levels[$this->user->loyaltyLevel]['hold_level_terms']['self_period_months'], 3) - 1) * (-1));
                $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES'] = $this->user->orderAmount->getOrdersTotalSumForUser($selfPeriodStart);
                $left = $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] - $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES'];
                $result['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'] = $left > 0 ? $left : 0;

                // Получим необходимые данные по затратам для повышения на следующий уровень
                if (isset($nextLevel)) {
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] = $levels[$nextLevel]['upgrade_level_terms']['self_total'];
                    $selfPeriodStart = DateTimeService::getStartOfQuarter((intdiv($levels[$nextLevel]['upgrade_level_terms']['self_period_months'], 3) - 1) * (-1));
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES'] = $this->user->orderAmount->getOrdersTotalSumForUser($selfPeriodStart);
                    $left = $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'] - $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES'];
                    $result['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'] = $left > 0 ? $left : 0;
                }

            // Показатели для Конечных пользователей
            } elseif ($this->user->groups->isBuyer()) {

                $result['PERSONAL_DISCOUNT'] = $levels[$this->user->loyaltyLevel]['benefits']['personal_discount'];

                if (isset($nextLevel)) {
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
}