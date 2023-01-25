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

        if (Environment::isProd()) {
            $this->smsClient->sendMessage(
                sprintf(
                    Loc::getMessage('CONFIRMATION_SERVICE_PHONE_VERIFY_TEMPLATE'),
                    $code
                ),
                $phone ?? $this->user->phone
            );
        }
    }

    public function sendEmailConfirmation(): void
    {
        $code = $this->generateUserCheckWord($this->user->id);

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
                'NAME' => $this->user->name ?? '',
                'LAST_NAME' => $this->user->lastName ?? '',
                'EMAIL' => $this->user->email,
                'USER_ID' => $this->user->id,
                'CONFIRM_CODE' => $code,
            ],
        ]);
    }

    public function verifySmsCode(string $code): bool
    {
        $actualCode = ConfirmationTable::getActiveSmsCode($this->user->fUserID);

        if (! Environment::isProd()) {
            return true;
        }

        return $actualCode && hash_equals($actualCode, $code);
    }

    public function verifyEmailCode(string $code, string $type): bool
    {
        $actualCode = ConfirmationTable::getActiveEmailCode($this->user->fUserID, $type);

        $seconds = time() - $actualCode['UF_CREATED_AT']->getTimestamp();

        $time = $seconds > 0 ? $seconds / $this->hourInSeconds : 0;

        // Если код просрочен - отказ
        if ((float) $time > 1.0) {
            return false;
        }

        // Если какой-то из кодов не задан - отказ
        if (! isset($actualCode['UF_CODE']) || empty($actualCode['UF_CODE']) || empty($code)) {
            return false;
        }

        // Если коды эквивалентны - подтверждено
        if (hash_equals($actualCode['UF_CODE'], $code)) {
            return true;
        }

        return false;
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
        return hash_hmac('sha384', \CMain::GetServerUniqID().uniqid(), '5yt7GD4rvx8gi4r');
    }
}
