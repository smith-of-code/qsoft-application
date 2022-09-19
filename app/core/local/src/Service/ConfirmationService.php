<?php

namespace QSoft\Service;

use Bitrix\Main\Mail\Event;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UserTable;
use QSoft\Client\SmsClient;
use QSoft\ORM\ConfirmationTable;

Loc::loadMessages(__FILE__);

class ConfirmationService
{
    public const CODE_LENGTH = 6;

    private SmsClient $smsClient;

    public function __construct()
    {
        $this->smsClient = new SmsClient;
    }

    public function sendSmsConfirmation(int $userId, string $type = ConfirmationTable::TYPES['confirm_phone']): void
    {
        $user = UserTable::getById($userId)->fetch();
        $code = $this->generateCode();

        ConfirmationTable::add([
            'UF_USER_ID' => $userId,
            'UF_CHANNEL' => ConfirmationTable::CHANNELS['sms'],
            'UF_TYPE' => $type,
            'UF_CODE' => $code,
        ]);

        $this->smsClient->sendMessage(
            sprintf(
                Loc::getMessage('CONFIRMATION_SERVICE_PHONE_VERIFY_TEMPLATE'),
                $code
            ),
            $user['LOGIN']
        );
    }

    public function sendEmailConfirmation(int $userId)
    {
        $user = UserTable::getById($userId)->fetch();
        $code = $this->generateCode();

        ConfirmationTable::add([
            'UF_USER_ID' => $userId,
            'UF_CHANNEL' => ConfirmationTable::CHANNELS['email'],
            'UF_TYPE' => ConfirmationTable::TYPES['confirm_email'],
            'UF_CODE' => $code,
        ]);

        return Event::send([
            'EVENT_NAME' => 'NEW_USER_CONFIRM',
            'LID' => SITE_ID,
            'C_FIELDS' => [
                'EMAIL' => $user['EMAIL'],
                'USER_ID' => $userId,
                'CONFIRM_CODE' => $code,
            ],
        ])->getErrorMessages();
    }

    public function verifySmsCode(int $userId, string $code): bool
    {
        $actualCode = ConfirmationTable::getActiveSmsCode($userId);

        return $actualCode && $actualCode === $code;
    }

    public function verifyEmailCode(int $userId, string $code): bool
    {
        $actualCode = ConfirmationTable::getActiveEmailCode($userId);

        return $actualCode && $actualCode === $code;
    }

    private function generateCode(): string
    {
        return (string) rand(10 ** (self::CODE_LENGTH - 1), 10 ** self::CODE_LENGTH - 1);
    }
}