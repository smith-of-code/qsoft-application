<?php

namespace QSoft\Events;

use Bitrix\Main\UserPhoneAuthTable;
use Bitrix\Main\UserTable;
use CUser;
use QSoft\Entity\User;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\BuyerLoyaltyProgramHelper;
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
                && $user->getMentor()->id !== (int) $fields['UF_MENTOR_ID']
                && $user->id !== (int) $fields['UF_MENTOR_ID']
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
        // Назначаем уровень в программе лояльности
        $loyalty = new BuyerLoyaltyProgramHelper();
        $firstLevel = $loyalty->getLowestLevel();
        $levelsIDs = $loyalty->getLevelsIDs();
        if (! $fields['UF_LOYALTY_LEVEL']) {
            $fields['UF_LOYALTY_LEVEL'] = $levelsIDs[$firstLevel];
        }
    }

    public static function OnBeforeUserLogin(array &$params): bool
    {
        if (ADMIN_SECTION === true) return true;
        if (UserPhoneAuthTable::validatePhoneNumber($params['LOGIN']) === true) {
            $user = UserTable::getRow(['filter' => ['=PERSONAL_PHONE' => $params['LOGIN']], 'select' => ['ID', 'LOGIN']]);
        } elseif (check_email($params['LOGIN'])) {
            $user = UserTable::getRow(['filter' => ['=EMAIL' => $params['LOGIN']], 'select' => ['ID', 'LOGIN']]);
        } else {
            return false;
        }
        if (!$user) {
            return false;
        }
        $params['LOGIN'] = $user['LOGIN'];
        return !($_POST['NOT_ACTIVE_ERROR'] = !CUser::GetByID($user['ID'])->GetNext()['UF_EMAIL_CONFIRMED']);
    }
}