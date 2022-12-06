<?php

namespace QSoft\Events;

use Bitrix\Main\UserPhoneAuthTable;
use Bitrix\Main\UserTable;
use CUser;
use QSoft\Entity\User;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\BuyerLoyaltyProgramHelper;
use QSoft\Queue\Jobs\BeneficiaryChangeJob;
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

        // Если произошло изменение ментора
        if (
            is_numeric($fields['UF_MENTOR_ID'])
            && (int) $fields['UF_MENTOR_ID'] > 0
            && $user->getMentor()->id !== (int) $fields['UF_MENTOR_ID']
            && $user->id !== (int) $fields['UF_MENTOR_ID']
        ) {
            $userMentor = new User($fields['UF_MENTOR_ID']);
            if (!$userMentor->active || !$userMentor->groups->isConsultant()) {
                throw new RuntimeException('Указанный в качестве наставника пользователь не может быть наставником.');
            }

            BeneficiaryChangeJob::pushJob([
                'userId' => $user->id,
                'oldMentorId' => $user->getMentor()->id,
                'newMentorId' => $fields['UF_MENTOR_ID'],
            ]);

            if ($user->groups->isConsultant()) {
                (new BonusAccountHelper)->addReferralBonuses($userMentor);
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
        if (defined('ADMIN_SECTION') && ADMIN_SECTION === true) {
            return true;
        }
        if (check_email($params['LOGIN'])) {
            $user = UserTable::getRow(['filter' => ['=EMAIL' => $params['LOGIN']], 'select' => ['ID', 'LOGIN']]);
        } else {
            if (str_starts_with($params['LOGIN'], '8')) {
                $params['LOGIN'] = '+7' . substr($params['LOGIN'], 1);
            } elseif (str_starts_with($params['LOGIN'], '7')) {
                $params['LOGIN'] = "+{$params['LOGIN']}";
            }
            $user = UserTable::getRow(['filter' => ['=PERSONAL_PHONE' => UserPhoneAuthTable::normalizePhoneNumber($params['LOGIN'])], 'select' => ['ID', 'LOGIN']]);
        }
        if (!$user) {
            return false;
        }
        $params['LOGIN'] = $user['LOGIN'];
        return !($_POST['NOT_ACTIVE_ERROR'] = !CUser::GetByID($user['ID'])->GetNext()['UF_EMAIL_CONFIRMED']);
    }
}
