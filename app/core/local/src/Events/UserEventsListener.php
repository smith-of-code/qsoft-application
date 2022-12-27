<?php

namespace QSoft\Events;

use BasketLineController;
use Bitrix\Main\Loader;
use Bitrix\Main\UserTable;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Fuser;
use CCatalogProduct;
use CUser;
use QSoft\Entity\User;
use QSoft\Helper\BasketHelper;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\BuyerLoyaltyProgramHelper;
use QSoft\Queue\Jobs\BeneficiaryChangeJob;
use RuntimeException;

class UserEventsListener
{
    private static int $fUserId = 0;

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
        Loader::includeModule('sale');

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
        self::$fUserId = FUser::getId();
        return !($_POST['NOT_ACTIVE_ERROR'] = !CUser::GetByID($user['ID'])->GetNext()['UF_EMAIL_CONFIRMED']);
    }

    public static function OnAfterUserAuthorize(array $params)
    {
        $authBasketHelper = new BasketHelper;
        $basket = (new BasketHelper(self::$fUserId ?: null))->getBasket();
        /** @var BasketItem $basketItem */
        foreach ($basket as $basketItem) {
            $detailPage = '/404/';
            $nonreturnable = false;
            foreach ($basketItem->getPropertyCollection() as $property) {
                if ($property->getField('CODE') === 'DETAIL_PAGE') {
                    $detailPage = $property->getField('VALUE');
                }
                if ($property->getField('CODE') === 'NONRETURNABLE') {
                    $nonreturnable = (bool)$property->getField('VALUE');
                }
            }
            $authBasketHelper->increase($basketItem->getProductId(), $detailPage, $nonreturnable, $basketItem->getQuantity());
            $basketItem->delete();
//            $basketItem->save();
        }
        $basket->save();
    }
}
