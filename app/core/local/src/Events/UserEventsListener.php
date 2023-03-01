<?php

namespace QSoft\Events;

use BasketLineController;
use Bitrix\Main\Loader;
use Bitrix\Main\Mail\Event as EmailEvent;
use Bitrix\Main\UserTable;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Fuser;
use CCatalogProduct;
use CUser;
use QSoft\Client\SmsClient;
use QSoft\Entity\User;
use QSoft\Helper\BasketHelper;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\BuyerLoyaltyProgramHelper;
use QSoft\Helper\UserGroupHelper;
use QSoft\ORM\BeneficiariesTable;
use QSoft\Notifiers\EditingFromAdminPanelNotifier;

class UserEventsListener
{
    private static int $fUserId = 0;

    /**
     * @throws \Exception
     */
    public static function OnBeforeUserUpdate(array &$fields)
    {
        global $APPLICATION;

        // Пользователь, для которого вносятся изменения
        $user = new User($fields['ID']);
        $userData = $user->getPersonalData();

        if (isset($fields['UF_BONUS_POINTS']) && (!is_numeric($fields['UF_BONUS_POINTS']) || (int)$fields['UF_BONUS_POINTS'] < 0)) {
            $fields['UF_BONUS_POINTS'] = 0;
        }

        // Если произошло изменение ментора
        if (isset($fields['UF_MENTOR_ID']) && $user->mentorId !== (int) $fields['UF_MENTOR_ID']) {

            if (!$fields['UF_MENTOR_ID']) {
                $APPLICATION->throwException('Пользователь обязан иметь наставника');
                return false;
            }

            if (!is_numeric($fields['UF_MENTOR_ID']) || (int) $fields['UF_MENTOR_ID'] <= 0) {
                $APPLICATION->throwException('Некорректный ID наставника');
                return false;
            }

            try {
                $mentor = new User($fields['UF_MENTOR_ID']);
            } catch (\Exception $e) {
                $APPLICATION->throwException($e->getMessage());
                return false;
            }

            if (
                $user->id === (int) $fields['UF_MENTOR_ID']
                || ! $mentor->active
                || ! $mentor->groups->isConsultant()
                || in_array($mentor->id, $user->beneficiariesService->getTeamIds())
            ) {
                $APPLICATION->throwException('Указанный пользователь не может быть наставником.');
                return false;
            }

            // Если у пользователя уже был задан наставник - найдем соответствующую запись и удалим
            if ($user->mentorId) {
                $oldRelation = BeneficiariesTable::getRow([
                    'filter' => [
                        '=UF_USER_ID' => $user->id,
                        '=UF_BENEFICIARY_ID' => $user->mentorId,
                    ],
                    'select' => ['ID'],
                ]);
                if ($oldRelation) {
                    BeneficiariesTable::delete($oldRelation['ID']);
                }
            }

            BeneficiariesTable::add([
                'UF_USER_ID' => $user->id,
                'UF_BENEFICIARY_ID' => $mentor->id,
            ]);

            if ($APPLICATION->GetCurPage() == '/bitrix/admin/user_edit.php') {
                self::sendNotification('CHANGE_MENTOR', $fields);
            }

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

        // Если пользователь стал консультантом
        if (isset($userData['loyalty_level'])) {
            $userLoyalty = \CUserFieldEnum::GetList([], ['ID' => $fields['UF_LOYALTY_LEVEL']])->fetch()['VALUE'];

            if (mb_substr($userLoyalty, 0, 1) == 'K' && mb_substr($userData['loyalty_level'], 0, 1) == 'B') {
                if ($APPLICATION->GetCurPage() == '/bitrix/admin/user_edit.php') {
                    self::sendNotification('BECOME_CONSULTANT', $userData);
                }
            }
        }

        // Если произошло изменение персональных данных
        if ($APPLICATION->GetCurPage() == '/bitrix/admin/user_edit.php') {
            $arrComparison = [
                'first_name' => 'NAME',
                'last_name' => 'LAST_NAME',
                'second_name' => 'SECOND_NAME',
                'gender' => 'PERSONAL_GENDER',
                'birthdate' => 'PERSONAL_BIRTHDAY',
                'email' => 'EMAIL',
                'phone' => 'PERSONAL_PHONE',
                'city' => 'PERSONAL_CITY',
            ];
            foreach ($arrComparison as $data => $field) {
                if ($fields[$field] != $userData[$data]) {
                    self::sendNotification('CHANGE_OF_PERSONAL_DATA', $userData);
                    break;
                }
            }
        }
    }

    public static function OnBeforeUserAdd(array &$fields)
    {
        global $APPLICATION;

        // Назначаем уровень в программе лояльности
        $loyalty = new BuyerLoyaltyProgramHelper();
        $firstLevel = $loyalty->getLowestLevel();
        $levelsIDs = $loyalty->getLevelsIDs();
        if (! $fields['UF_LOYALTY_LEVEL']) {
            $fields['UF_LOYALTY_LEVEL'] = $levelsIDs[$firstLevel];
        }

        if ($APPLICATION->GetCurPage() == '/bitrix/admin/user_edit.php') {
            $notifier = New EditingFromAdminPanelNotifier('ADD_NEW_USER', $fields);
            $message = $notifier->getMessage();
            if (!empty($fields['PHONE_NUMBER'])) {
                self::sendSMS($message, $fields['PHONE_NUMBER']);
            }
            if (!empty($fields['EMAIL'])) {
                self::sendEmail($fields, 'ADD_NEW_USER', $message);
            }
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

    private function sendNotification(string $eventName, array $fields): void
    {
        $sms = ['CHANGE_MENTOR', 'BECOME_CONSULTANT'];

        $user = new User($fields['ID']);
        $userData = $user->getPersonalData();

        $notifier = New EditingFromAdminPanelNotifier($eventName, $fields);
        $user->notification->sendNotification(
            $notifier->getTitle(),
            $notifier->getMessage(),
            $notifier->getLink()
        );

        $message = $notifier->getMessage();
        if (!empty($userData['phone']) && in_array($eventName, $sms)) {
            self::sendSMS($message, $userData['phone']);
        }
        if (!empty($userData['email'])) {
            self::sendEmail($userData, $notifier->getTitle(), $message);
        }
    }

    private function sendSMS(string $message, string $phoneNumber): void
    {
        $smsClient = new SmsClient();
        $smsClient->sendMessage($message, $phoneNumber);
    }

    private function sendEmail(array $userData, string $title, $message): void
    {
        $fullName = $userData['full_name'] ??
            $userData['LAST_NAME'] . ' ' . $userData['NAME'] . ' ' . $userData['SECOND_NAME'];

        $fields = [
            "MESSAGE_TAKER" => $userData['OWNER_EMAIL'] ?? $userData['EMAIL'], // почта получателя
            "MESSAGE_TEXT" => $message, // текст уведомления
            "OWNER_NAME" => $fullName, // ФИО пользователя
            "TITLE" => $title, // Тема письма
        ];

        \CEvent::Send('NOTIFICATION_EVENT', SITE_ID, $fields);
    }
}
