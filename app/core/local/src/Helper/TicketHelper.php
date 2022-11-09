<?php

namespace QSoft\Helper;

use Bitrix\Highloadblock\HighloadBlockTable;
use CModule;
use CTicket;
use QSoft\Entity\User;
use RuntimeException;

class TicketHelper
{
    public const TYPES = [
        'PERSONAL_DATA_CHANGE_APPLICATION' => 'Заявка на смену персональных данных',
    ];

    public function __construct()
    {
        $this->includeModules();
    }

    public function includeModules()
    {
        CModule::IncludeModule('support');
    }

    public function createTicket(int $userId, string $type): int
    {
        if (!in_array($type, self::TYPES)) {
            throw new RuntimeException('Incorrect ticket type');
        }

        $user = new User($userId);
        $messageId = null;
        CTicket::Set([
            'TITLE' => 'Заявка на изменение персональных данных',
            'OWNER_SID' => $user->phone,
            'OWNER_USER_ID' => $user->id,
            'MESSAGE' => $message,
            'UF_DATA' => $data,
            'CATEGORY_ID' =>
        ], $messageId);
        return $messageId;
    }

    public function getCategoryId(string $categoryCode)
    {
        \CTicketDictionary::GetBySID($categoryCode)
    }
}