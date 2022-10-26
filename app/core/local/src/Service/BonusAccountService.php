<?php


namespace QSoft\Service;


use CSaleUserAccount;
use DateTime;
use QSoft\Entity\User;
use QSoft\ORM\TransactionTable;
use QSoft\PropertiesDigest\Transactions;

class BonusAccountService
{
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

//    public function getAccount()
//    {
//        return CSaleUserAccount::GetByUserID($this->user->id, self::CURRENCY);
//    }

//    public function createAccount(int $amount = 0): int
//    {
//        $result = 0;
//
//        if (!CSaleUserAccount::GetByUserID($this->user->id, self::CURRENCY)) {
//            $arFields = [
//                "USER_ID" => $this->user->id,
//                "CURRENCY" => self::CURRENCY,
//                "CURRENT_BUDGET" => $amount
//            ];
//            $result = CSaleUserAccount::Add($arFields);
//        }
//
//        return $result;
//    }

//    public function payBonuses(int $amount, $orderId): bool
//    {
//        return CSaleUserAccount::Pay(
//            $this->user->id,
//            $amount,
//            self::CURRENCY,
//            $orderId,
//            false
//        );
//    }
//
//    public function updateAccount(int $changeSum, $actionInfo): bool
//    {
//        return CSaleUserAccount::UpdateAccount(
//            $this->user->id,
//            $changeSum,
//            self::CURRENCY,
//            $actionInfo
//        );
//    }

    public function storeOrderBonuses($amount): void
    {
        $_SESSION[self::SESSION_BONUS_OFF_KEY] = $amount;
    }

    public function getStoredBonuses(): int
    {
        return (int)$_SESSION[self::SESSION_BONUS_OFF_KEY] ?? 0;
    }

    public function clearStoredBonuses(): void
    {
        unset($_SESSION[self::SESSION_BONUS_OFF_KEY]);
    }

    public function accrue(int $amount, string $reason, string $source , int $orderId = null)
    {
        TransactionTable::add([
            'UF_USER_ID' => $this->user->id,
            'UF_CREATED_AT' => new DateTime(),
            'UF_TYPE' => $reason,
            'UF_SOURCE' => $source,
            'UF_MEASURE' => Transactions::MEASURE_BONUSES,
            'UF_AMOUNT' => $amount,
            'UF_ORDER_ID' => $orderId
        ]);

        $this->user->update([
            'UF_BONUS_POINTS' => $this->user->bonusPoints + $amount
        ]);
    }
}