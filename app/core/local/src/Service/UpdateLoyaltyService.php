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
                    $this->setLog(
                        'У пользователя задан не корректный уровень лояльности',
                        'error',
                        [
                            'USER_ID' => $user->id,
                            'IS_CONSULTANT' => $user->groups->isConsultant(),
                            'CURRENT_LEVEL' => $user->loyaltyLevel,
                        ]
                    );
                } catch(RuntimeException $e) {
                    $this->setLog(
                        'У пользователя задан не корректный уровень лояльности',
                        'error',
                        [
                            'USER_ID' => $user->id,
                            'IS_CONSULTANT' => $user->groups->isConsultant(),
                            'CURRENT_LEVEL' => $user->loyaltyLevel,
                        ]
                    );
                }
            }

            if ($user->groups->isConsultant()) {
                try{
                    $this->updateConsultantLoyaltyLevel($user);
                } catch(RuntimeException $e) {
                    $this->setLog(
                        'У пользователя задан не корректный уровень лояльности',
                        'error',
                        [
                            'USER_ID' => $user->id,
                            'IS_CONSULTANT' => $user->groups->isConsultant(),
                            'CURRENT_LEVEL' => $user->loyaltyLevel,
                        ]
                    );
                }
            }

            unset($user);
        }
    }

    private function updateBuyersLoyaltyLevel(User $user)
    {
        $helper = new BuyerLoyaltyProgramHelper(true);

        $helper->upgradeLoyaltyLevel($user);

        unset($helper);
    }

    private function updateConsultantLoyaltyLevel(User $user)
    {
        $helper = new ConsultantLoyaltyProgramHelper(true);

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
        $usersResult = (new CUser())->GetList();

        while ($raw = $usersResult->GetNext()){
            $users[] = $raw['ID'];
        }

        unset($usersResult);

        return $users ?? [];
    }

    private function setLog($message, $type, $context = [])
    {
        $logFile 
            = $_SERVER["DOCUMENT_ROOT"]
                . '/local/php_interface/include/logs/cron/user.loyalty.service.update_'
                . FormatDate('d.m.Y')
                . '.log';
        $maxLogSize = 0;

        $logger = new FileLogger($logFile, $maxLogSize);
        if ($type == LogLevel::ERROR) {
            $logger->setLevel(LogLevel::ERROR);
            $logger->error($message, $context);
        } elseif($type == LogLevel::DEBUG) {
            $logger->setLevel(LogLevel::DEBUG);
            $logger->debug($message, $context);
        }
    }
}
