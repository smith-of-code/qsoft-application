<?php

namespace QSoft\Helper;

use CModule;
use CTicket;
use CTicketDictionary;
use QSoft\Entity\User;
use RuntimeException;

class TicketHelper
{
    public const CHANGE_PERSONAL_DATA_CATEGORY = 'CHANGE_OF_PERSONAL_DATA';
    public const CHANGE_LEGAL_ENTITY_DATA_CATEGORY = 'CHANGE_OF_LEGAL_ENTITY_DATA';
    public const CHANGE_MENTOR = 'CHANGE_MENTOR';
    public const REGISTRATION_CATEGORY = 'REGISTRATION';
    public const CHANGE_ROLE_CATEGORY = 'CHANGE_ROLE';
    public const SUPPORT_CATEGORY = 'SUPPORT';

    public const CATEGORIES = [
        self::CHANGE_PERSONAL_DATA_CATEGORY => [
            'TITLE' => 'Заявка на смену персональных данных',
            'DETAIL_PAGE' => '/bitrix/admin/personal_data.php?ID=%s',
        ],
        self::CHANGE_LEGAL_ENTITY_DATA_CATEGORY => [
            'TITLE' => 'Заявка на смену юридических данных',
            'DETAIL_PAGE' => '/bitrix/admin/legal_entity_data.php?ID=%s',
        ],
        self::CHANGE_MENTOR => [
            'TITLE' => 'Заявка на смену ментора',
            'DETAIL_PAGE' => '/bitrix/admin/mentor.php?ID=%s',
        ],
    ];

    public function __construct()
    {
        $this->includeModules();
    }

    public function includeModules()
    {
        CModule::IncludeModule('support');
    }

    public function createTicket(int $userId, string $category, string $data): int
    {
        if (!in_array($category, array_keys(self::CATEGORIES))) {
            throw new RuntimeException('Incorrect ticket category');
        }

        $user = new User($userId);
        $messageId = null;
        $ticketId = CTicket::Set([
            'TITLE' => self::CATEGORIES[$category]['TITLE'],
            'OWNER_SID' => $user->phone,
            'OWNER_USER_ID' => $user->id,
            'MESSAGE' => self::CATEGORIES[$category]['TITLE'],
            'UF_DATA' => $data,
            'CATEGORY_ID' => $this->getCategoryId($category),
        ], $messageId);

        $files = null;
        CTicket::AddMessage($ticketId, [
            'MESSAGE_AUTHOR_SID' => $user->phone,
            'MESSAGE_AUTHOR_USER_ID' => $user->id,
            'MESSAGE' => 'Детальная страница обращения: ' . $this->getCurrentUrl() . sprintf(self::CATEGORIES[$category]['DETAIL_PAGE'], $ticketId),
        ], $files);

        return $ticketId;
    }

    public function getCurrentUrl(): string
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    }

    public function getTicketData(int $id): array
    {
        $rsTicket = CTicket::GetByID($id, LANG, 'Y',  'Y', 'Y', ['SELECT' => ['UF_DATA']]);

        if (!$arTicket = $rsTicket->GetNext()) {
            return [];
        }

        return json_decode($arTicket['~UF_DATA'], true) ?? [];
    }

    public function getCategoryId(string $categoryCode): int
    {
        return CTicketDictionary::GetList('', '', ['SID' => $categoryCode])->GetNext()['ID'];
    }
}