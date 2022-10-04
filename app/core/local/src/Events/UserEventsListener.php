<?php

namespace QSoft\Events;

use QSoft\Entity\User;
use RuntimeException;

class UserEventsListener
{
    private static function initDependencies(): void
    {
    }

    public static function OnBeforeUserUpdate(array $fields)
    {
        self::initDependencies();

        $user = new User($fields['ID']);

        if ($user->userGroupsService->isConsultant()) {
            if (is_numeric($fields['UF_MENTOR_ID']) && $user->mentor_id !== $fields['UF_MENTOR_ID']) {
                //Получим юзера-ментора
                $userMentor = new User($fields['UF_MENTOR_ID']);
                if (
                    ! $userMentor->isActive()
                    || ! $userMentor->isConsultant()
                ) {
                    throw new RuntimeException('Invalid mentor ID');
                }
                $userMentor->bonusAccountService->addReferralBonuses();
            }
        }
    }
}