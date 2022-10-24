<?php

namespace QSoft\Events;

use QSoft\Entity\User;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\LoyaltyProgramHelper;
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
                && (int) $fields['UF_MENTOR_ID'] > 0
                && $user->mentor !== $fields['UF_MENTOR_ID']
                && $user->id !== $fields['UF_MENTOR_ID']
            ) {
                // Получим нового юзера-наставника
                $userMentor = new User($fields['UF_MENTOR_ID']);
                if (
                    ! isset($userMentor)
                    || ! $userMentor->active
                    || ! $userMentor->groups->isConsultant()
                ) {
                    throw new RuntimeException('Указанный в качестве наставника пользователь не может быть наставником.');
                }
                (new BonusAccountHelper())->addReferralBonuses($userMentor);
            }
        }
    }

    public static function OnBeforeUserAdd(array &$fields)
    {
        if (!$fields['UF_LOYALTY_LEVEL']) {
            $fields['UF_LOYALTY_LEVEL'] = LoyaltyProgramHelper::LOYALTY_LEVEL_K1;
        }
        if (!$fields['UF_PERSONAL_DISCOUNT_LEVEL']) {
            $fields['UF_PERSONAL_DISCOUNT_LEVEL'] = BonusAccountHelper::BONUS_ACCOUNT_LEVEL_B1;
        }
    }
}