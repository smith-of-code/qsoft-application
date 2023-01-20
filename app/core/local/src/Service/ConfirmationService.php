<?php

namespace QSoft\Service;

use Bitrix\Main\Authentication\Context;
use Bitrix\Main\Authentication\ShortCode;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Fuser;
use QSoft\Client\SmsClient;
use QSoft\Entity\User;
use QSoft\Environment;
use QSoft\ORM\ConfirmationTable;

Loc::loadMessages(__FILE__);

class ConfirmationService
{
    public const CODE_LENGTH = 6;

    private $hourInSeconds = 3600;

    private User $user;
    private SmsClient $smsClient;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->smsClient = new SmsClient;
    }

    public function sendSmsConfirmation(?string $phone = null): void
    {
        $code = $this->generateCode();

        ConfirmationTable::add([
            'UF_FUSER_ID' => $this->user->fUserID,
            'UF_CHANNEL' => ConfirmationTable::CHANNELS['sms'],
            'UF_TYPE' => ConfirmationTable::TYPES['confirm_phone'],
            'UF_CODE' => $code,
        ]);

        $this->smsClient->sendMessage(
            sprintf(
                Loc::getMessage('CONFIRMATION_SERVICE_PHONE_VERIFY_TEMPLATE'),
                $code
            ),
            $phone ?? $this->user->phone
        );
    }

    public function sendEmailConfirmation(): void
    {
        $code = $this->generateCode();

        ConfirmationTable::add([
            'UF_FUSER_ID' => $this->user->fUserID,
            'UF_CHANNEL' => ConfirmationTable::CHANNELS['email'],
            'UF_TYPE' => ConfirmationTable::TYPES['confirm_email'],
            'UF_CODE' => $code,
        ]);

        Event::send([
            'EVENT_NAME' => 'NEW_USER_CONFIRM',
            'LID' => SITE_ID,
            'C_FIELDS' => [
                'EMAIL' => $this->user->email,
                'USER_ID' => $this->user->id,
                'CONFIRM_CODE' => $code,
            ],
        ]);
    }

    public function sendResetPasswordEmail(): void
    {
        $code = $this->generateUserCheckWord($this->user->id);

        ConfirmationTable::add([
            'UF_FUSER_ID' => $this->user->fUserID,
            'UF_CHANNEL' => ConfirmationTable::CHANNELS['email'],
            'UF_TYPE' => ConfirmationTable::TYPES['reset_password'],
            'UF_CODE' => $code,
        ]);

        Event::send([
            'EVENT_NAME' => 'USER_PASS_REQUEST',
            'LID' => SITE_ID,
            'C_FIELDS' => [
                'EMAIL' => $this->user->email,
                'USER_ID' => $this->user->id,
                'CONFIRM_CODE' => $code,
            ],
        ]);
    }

    public function verifySmsCode(string $code): bool
    {
        $actualCode = ConfirmationTable::getActiveSmsCode($this->user->fUserID);

        return $actualCode && $actualCode === $code;
    }

    public function verifyEmailCode(string $code, string $type): bool
    {
        $actualCode = ConfirmationTable::getActiveEmailCode($this->user->fUserID, $type);

        $seconds = time() - $actualCode['UF_CREATED_AT']->getTimestamp();

        $time = $seconds > 0 ? $seconds / $this->hourInSeconds : 0;

        return $actualCode['UF_CODE'] 
            && ($actualCode['UF_CODE'] === $code)
            && ((float)$time <= 1.0);
    }

    private function generateCode(): string
    {
        return (string) rand(10 ** (self::CODE_LENGTH - 1), 10 ** self::CODE_LENGTH - 1);
    }

    private function generateCodeOTP(int $userId): ?string
    {
        $context = (new Context)->setUserId($userId);
        $shortCode = new ShortCode($context);

        if ($shortCode->checkDateSent()->isSuccess()) {
            $shortCode->saveDateSent();
            return $shortCode->generate();
        }

        return null;
    }

    private function generateUserCheckWord(int $userId): ?string
    {
        global $USER;

        $dbUser = $USER->GetList('', '', ['LOGIN' => htmlspecialcharsbx($_REQUEST['USER_LOGIN'])]);

        if ($arUser = $dbUser->fetch()) {
            return $arUser["CHECKWORD"];
        }

        return '';
    }
}
