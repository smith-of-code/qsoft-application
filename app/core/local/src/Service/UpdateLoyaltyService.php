<?php

namespace QSoft\Service;

use CUser;
use Exception;
use Psr\Log\LogLevel;
use QSoft\Entity\User;
use Bitrix\Main\Diag\FileLogger;
use QSoft\Helper\BuyerLoyaltyProgramHelper;
use QSoft\Helper\ConsultantLoyaltyProgramHelper;
use RuntimeException;
use QSoft\Logger\Logger;

class UpdateLoyaltyService
{
    public function updateBuyerLoyalty()
    {
        $allUsersIds = $this->getAllUsersIds();

        foreach ($allUsersIds as $id) {
            $user = new User($id);

            if ($user->groups->isBuyer()) {
                try{
                    $this->updateBuyersLoyaltyLevel($user);
                } catch(RuntimeException $e) {
                    Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $e->getMessage());
                }
            }

            if ($user->groups->isConsultant()) {
                try{
                    $this->updateConsultantLoyaltyLevel($user);
                } catch(RuntimeException $e) {
                    Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $e->getMessage());
                }
            }

            unset($user);
        }
    }

    public function updateConsultantLoyalty()
    {
        $allUsersIds = $this->getAllUsersIds();

        foreach ($allUsersIds as $id) {
            $user = new User($id);

            if ($user->groups->isConsultant()) {
                try{
                    $this->updateConsultantLoyaltyLevel($user);
                } catch(RuntimeException $e) {
                    //Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $e->getMessage());
                }
            }

            unset($user);
        }
    }

    private function updateBuyersLoyaltyLevel(User $user)
    {
        $helper = new BuyerLoyaltyProgramHelper();

        $helper->upgradeLoyaltyLevel($user);

        unset($helper);
    }

    private function updateConsultantLoyaltyLevel(User $user)
    {
        $helper = new ConsultantLoyaltyProgramHelper();

        $helper->upgradeLoyaltyLevel($user);

        unset($helper);
    }

    /**
     * Получаем ID всех пользователей.
     *
     * @return array
     * 
     */
    private function getAllUsersIds(): array
    {
        $usersResult = (new CUser())->GetList('', '', [], ['SELECT' => ['ID']]);

        while ($raw = $usersResult->GetNext()){
            $users[] = $raw['ID'];
        }

        unset($usersResult);

        return $users ?? [];
    }
}
