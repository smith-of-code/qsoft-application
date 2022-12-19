<?php

namespace QSoft\Events;

use Bitrix\Main\UserPhoneAuthTable;
use Bitrix\Main\UserTable;
use CUser;
use QSoft\Entity\User;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\BuyerLoyaltyProgramHelper;
use QSoft\Helper\UserGroupHelper;
use QSoft\ORM\BeneficiariesTable;
use QSoft\Queue\Jobs\BeneficiaryChangeJob;
use RuntimeException;

class UserEventsListener
{

    /**
     * @throws \Exception
     */
    public static function OnBeforeUserUpdate(array &$fields)
    {
        // Пользователь, для которого вносятся изменения
        $user = new User($fields['ID']);

        if (isset($fields['UF_BONUS_POINTS']) && (!is_numeric($fields['UF_BONUS_POINTS']) || (int)$fields['UF_BONUS_POINTS'] < 0)) {
            $fields['UF_BONUS_POINTS'] = 0;
        }

        // Если произошло изменение ментора
        if (isset($fields['UF_MENTOR_ID']) && $user->mentorId !== (int) $fields['UF_MENTOR_ID']) {
            if (!$fields['UF_MENTOR_ID']) {
                throw new RuntimeException('Пользователь обязан иметь наставника');
            }

            if (!is_numeric($fields['UF_MENTOR_ID']) || (int) $fields['UF_MENTOR_ID'] < 0) {
                throw new RuntimeException('Некорректный ID наставника');
            }

            $mentor = new User($fields['UF_MENTOR_ID']);
            if ($user->id === (int) $fields['UF_MENTOR_ID'] || !$mentor->active || !$mentor->groups->isConsultant()) {
                throw new RuntimeException('Указанный пользователь не может быть наставником.');
            }

            BeneficiariesTable::add([
                'UF_USER_ID' => $user->id,
                'UF_BENEFICIARY_ID' => $mentor->id,
            ]);

            if (
                $user->groups->isConsultant()
                || (
                    $fields['GROUP_ID']
                    && in_array(UserGroupHelper::getConsultantGroupId(), $fields['GROUP_ID'])
                )
            ) {
                (new BonusAccountHelper)->addReferralBonuses($mentor);
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
            $user = UserTable::getRow(['filter' => ['=PERSONAL_PHONE' => normalizePhoneNumber($params['LOGIN'])], 'select' => ['ID', 'LOGIN']]);
        }
        if (!$user) {
            return false;
        }
        $params['LOGIN'] = $user['LOGIN'];
        return !($_POST['NOT_ACTIVE_ERROR'] = !CUser::GetByID($user['ID'])->GetNext()['UF_EMAIL_CONFIRMED']);
    }
}
