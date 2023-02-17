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

class UpdateLoyaltyService
{
    public function updateUsersLoyalty()
    {
        $allUsersIds = $this->getAllUsersIds();

        foreach ($allUsersIds as $id) {
            $user = new User($id);

            if ($user->groups->isBuyer()) {
                try{
                    $this->updateBuyersLoyaltyLevel($user);
                } catch(RuntimeException $e) {
                    Logger::createLogger(
                        'user.loyalty.service.update_',
                        0,
                        LogLevel::ERROR,
                        $_SERVER["DOCUMENT_ROOT"] . '../logs/cron/'
                    )
                        ->setLog(
                            $e->getMessage(),
                            [
                                'message' => $e->getMessage(),
                                'user' => $user->id,
                                'namespace' => __CLASS__,
                                'file_path' => (new \ReflectionClass(__CLASS__))->getFileName(),
                            ],
                        );
                    throw $error;
                }
            }

            if ($user->groups->isConsultant()) {
                try{
                    $this->updateConsultantLoyaltyLevel($user);
                } catch(RuntimeException $e) {
                    Logger::createLogger(
                        'user.loyalty.service.update_',
                        0,
                        LogLevel::ERROR,
                        $_SERVER["DOCUMENT_ROOT"] . '../logs/cron/'
                    )
                        ->setLog(
                            $e->getMessage(),
                            [
                                'message' => $e->getMessage(),
                                'user' => $user->id,
                                'namespace' => __CLASS__,
                                'file_path' => (new \ReflectionClass(__CLASS__))->getFileName(),
                            ],
                        );
                    throw $error;
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
