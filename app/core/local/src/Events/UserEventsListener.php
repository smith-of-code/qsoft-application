<?php

namespace QSoft\Events;

use QSoft\Entity\User;
use RuntimeException;

class UserEventsListener
{

    /**
     * @throws \Exception
     */
    public static function OnBeforeUserUpdate(array $fields)
    {
        // Пользователь, для которого вносятся изменения
        $user = new User($fields['ID']);

        if ($user->groups->isConsultant()) {

            // Если задан корректный ID Консультанта,
            // а также он был изменен и не является ID самого пользователя
            if (is_numeric($fields['UF_MENTOR_ID'])
                && $user->mentorId !== $fields['UF_MENTOR_ID']
                && $user->id !== $fields['UF_MENTOR_ID']
            ) {
                //Получим юзера-ментора
                $userMentor = new User($fields['UF_MENTOR_ID']);
                if (
                    ! $userMentor->active
                    || ! $userMentor->groups->isConsultant()
                ) {
                    throw new RuntimeException('Invalid mentor ID');
                }
                $userMentor->bonusAccount->addReferralBonuses();
            }
        }
    }
}