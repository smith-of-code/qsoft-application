<?php


namespace QSoft\Service;


use Bitrix\Main\Application;
use QSoft\Entity\User;
use CSaleUserAccount;

class InnerBonusAccountService
{
    private const CURRENCY = "RUB";
    private const SESSION_BONUS_OFF_KEY = 'SESSION_BONUS_OFF';

    /**
     * @var User Пользователь
     */
    public User $user;

    /**
     * InnerBonusAccountService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function getAccount()
    {
        return CSaleUserAccount::GetByUserID($this->user->id, self::CURRENCY);
    }

    public function createAccount(int $amount = 0): int
    {
        $result = 0;

        if (!CSaleUserAccount::GetByUserID($this->user->id, self::CURRENCY)) {
            $arFields = [
                "USER_ID" => $this->user->id,
                "CURRENCY" => self::CURRENCY,
                "CURRENT_BUDGET" => $amount
            ];
            $result = CSaleUserAccount::Add($arFields);
        }

        return $result;
    }


    public function payBonuses(int $amount, $orderId): bool
    {
        return  CSaleUserAccount::Pay(
            $this->user->id,
            $amount,
            self::CURRENCY,
            $orderId,
            false
        );
    }

    public function updateAccount(int $changeSum, $actionInfo): bool
    {
        dump($changeSum);
        return CSaleUserAccount::UpdateAccount(
            $this->user->id,
            $changeSum,
            self::CURRENCY,
            $actionInfo
        );
    }

    public function storeOrderBonuses($amount)
    {
        $_SESSION[self::SESSION_BONUS_OFF_KEY] = $amount;
    }

    public function getStoredBonuses()
    {
        return $_SESSION[self::SESSION_BONUS_OFF_KEY] ?? 0;
    }

    public function clearStoredBonuses()
    {
        unset($_SESSION[self::SESSION_BONUS_OFF_KEY]);
    }
}