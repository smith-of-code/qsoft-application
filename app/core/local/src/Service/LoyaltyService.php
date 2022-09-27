<?php

namespace QSoft\Service;

use Bitrix\Main\Type\DateTime;
use QSoft\ORM\TransactionTable;
use RuntimeException;

class LoyaltyService
{
    private UserService $userService;
    private UserGroupsService $userGroupsService;

    public const LOYALTY_LEVELS = [
        'K1' => [
            'referral_size' => 100,
        ],
        'K2' => [
            'referral_size' => 150,
        ],
        'K3' => [
            'referral_size' => 200,
        ],
    ];

    public function __construct()
    {
        $this->userService = new UserService;
        $this->userGroupsService = new UserGroupsService;
    }

    public function addReferralBonuses(int $userId): bool
    {
        $user = $this->userService->getActive($userId);
        if (!$user) {
            throw new RuntimeException('User not found');
        }

        if (!$this->userGroupsService->isConsultant($user['ID'])) {
            throw new RuntimeException('User is not consultant');
        }
        $amount = self::LOYALTY_LEVELS[$user['UF_LOYALTY_LEVEL']]['referral_size'];

        TransactionTable::add([
            'UF_USER_ID' => $userId,
            'UF_TYPE' => TransactionTable::TYPES['referral'],
            'UF_SOURCE' => TransactionTable::SOURCES['personal'],
            'UF_MEASURE' => TransactionTable::MEASURES['points'],
            'UF_AMOUNT' => $amount,
        ]);

        return $this->userService->update($user['ID'], [
            'UF_BONUS_POINTS' => $user['UF_BONUS_POINTS'] + $amount,
            'UF_LOYALTY_CHECK_DATE' => new DateTime,
        ]);
    }
}