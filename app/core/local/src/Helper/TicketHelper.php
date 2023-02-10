<?php

namespace QSoft\Helper;

use CModule;
use CTicket;
use CTicketDictionary;
use QSoft\Entity\User;
use RuntimeException;
use Bitrix\Sale;
use Psr\Log\LogLevel;
use QSoft\Logger\Logger;

class TicketHelper
{
    public const CHANGE_PERSONAL_DATA_CATEGORY = 'CHANGE_OF_PERSONAL_DATA';
    public const CHANGE_LEGAL_ENTITY_DATA_CATEGORY = 'CHANGE_OF_LEGAL_ENTITY_DATA';
    public const BECOME_CONSULTANT_CATEGORY = 'BECOME_CONSULTANT';
    public const CHANGE_MENTOR = 'CHANGE_MENTOR';
    public const REFUND_ORDER = 'REFUND_ORDER';
    public const REGISTRATION_CATEGORY = 'REGISTRATION';
    public const CHANGE_ROLE_CATEGORY = 'CHANGE_ROLE';
    public const SUPPORT_CATEGORY = 'SUPPORT';

    public const CATEGORIES = [
        self::CHANGE_PERSONAL_DATA_CATEGORY => [
            'TITLE' => 'Заявка на смену персональных данных',
            'DETAIL_PAGE' => '/bitrix/admin/personal_data.php?%s=%s',
        ],
        self::CHANGE_LEGAL_ENTITY_DATA_CATEGORY => [
            'TITLE' => 'Заявка на смену юридических данных',
            'DETAIL_PAGE' => '/bitrix/admin/legal_entity_data.php?%s=%s',
        ],
        self::BECOME_CONSULTANT_CATEGORY => [
            'TITLE' => 'Заявка на становление консультантом',
            'DETAIL_PAGE' => '/bitrix/admin/legal_entity_data.php?%s=%s',
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
            $error = new RuntimeException('Incorrect ticket category');
            Logger::createLogger((new \ReflectionClass(__CLASS__))->getShortName(), 0, LogLevel::ERROR)
                ->setLog(
                    $error->getMessage(),
                    [
                        'message' => $error->getMessage(),
                        'namespace' => __CLASS__,
                        'file_path' => (new \ReflectionClass(__CLASS__))->getFileName(),
                    ],
                );
            throw $error;
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
            'CATEGORY_SID' => $category,
        ], $messageId);

        $files = null;
        $message = '';
        if ($category === self::CHANGE_LEGAL_ENTITY_DATA_CATEGORY) {
            $message .= 'Текущие юридические данные пользователя: ' . $this->getCurrentUrl() . sprintf(self::CATEGORIES[$category]['DETAIL_PAGE'], 'user_id', $ticketId) . "\n";
        }
        $message .= 'Детальная страница обращения: ' . $this->getCurrentUrl() . sprintf(self::CATEGORIES[$category]['DETAIL_PAGE'], 'ticket_id', $ticketId);
        CTicket::AddMessage($ticketId, [
            'MESSAGE_AUTHOR_SID' => $user->phone,
            'MESSAGE_AUTHOR_USER_ID' => $user->id,
            'MESSAGE' => $message,
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

    public function getCategorySid(int $categoryId): string
    {
        return CTicketDictionary::GetList('', '', ['ID' => $categoryId])->GetNext()['SID'];
    }

    public function getMenthorData(string $id): ?array
    {
        if ($id === 0) {
            return null;
        }

        return (new User($id))->getPersonalData();
    }

    public function getOrderStatus(string $id): ?string 
    {
		$registry = Sale\Registry::getInstance(Sale\Registry::REGISTRY_TYPE_ORDER);
        $orderStatusClassName = $registry->getOrderStatusClassName();
        $listStatusNames = $orderStatusClassName::getAllStatusesNames(LANGUAGE_ID);

        foreach($listStatusNames as $key => $data)
        {
            $result[$key] = $data;
        }

        return $result[$id] ?? null;
    }
}