<?php

namespace QSoft\Events;

use QSoft\Service\LoyaltyService;
use QSoft\Service\UserGroupsService;
use QSoft\Service\UserService;
use RuntimeException;

class UserEventsListener
{
    private static UserService $userService;
    private static UserGroupsService $userGroupService;
    private static LoyaltyService $loyaltyService;

    private static function initDependencies(): void
    {
        self::$userService = new UserService;
        self::$userGroupService = new UserGroupsService;
        self::$loyaltyService = new LoyaltyService;
    }

    public static function OnBeforeUserUpdate(array $fields)
    {
        self::initDependencies();

        $user = self::$userService->get($fields['ID']);
        if (!$user) {
            throw new RuntimeException('User not found');
        }

        if (self::$userGroupService->isConsultant($fields['ID'])) {
            if (is_numeric($fields['UF_MENTOR_ID']) && $user['UF_MENTOR_ID'] !== $fields['UF_MENTOR_ID']) {
                if (
                    !self::$userService->getActive($fields['UF_MENTOR_ID'])
                    || !self::$userGroupService->isConsultant($fields['UF_MENTOR_ID'])
                ) {
                    throw new RuntimeException('Invalid mentor ID');
                }
                self::$loyaltyService->addReferralBonuses($fields['UF_MENTOR_ID']);
            }
        }
    }
}