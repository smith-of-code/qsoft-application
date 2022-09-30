<?php

namespace QSoft\Service;

use Bitrix\Main\UserFieldTable;
use CUser;
use CUserFieldEnum;

class UserService
{
    private const ENUM_PROPERTIES = [
        'UF_LOYALTY_LEVEL',
    ];

    private CUser $user;

    public function __construct()
    {
        $this->user = new CUser;
    }

    public function get(int $userId): ?array
    {
        $user = $this->user::GetByID($userId);
        if (!$user || !$user = $user->fetch()) {
            return null;
        }

        foreach (self::ENUM_PROPERTIES as $enumProperty) {
            if ($user[$enumProperty]) {
                $user[$enumProperty] = CUserFieldEnum::GetList([], ['ID' => $user[$enumProperty]])->fetch()['VALUE'];
            }
        }

        return $user;
    }

    public function getCurrent(): ?array
    {
        global $USER;
        return $USER->GetID() ? $this->get($USER->GetID()) : null;
    }

    public function getActive(int $userId): ?array
    {
        $user = $this->get($userId);

        if (!$user || $user['ACTIVE'] === 'N' || $user['BLOCKED'] === 'Y') {
            return null;
        }

        return $user;
    }

    public function activate(int $userId): bool
    {
        if ($this->update($userId, ['ACTIVE' => 'Y'])) {
            return $this->user->Authorize($userId);
        }
        return false;
    }

    public function update(int $userId, array $fields): bool
    {
        return (new CUser)->Update($userId, $fields);
    }
}