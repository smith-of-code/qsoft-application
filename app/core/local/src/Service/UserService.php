<?php

namespace QSoft\Service;

use CUser;
use QSoft\Entity\User;

class UserService
{
    /**
     * @var CUser Объект пользователя Битрикса
     */
    private CUser $c_user;
    /**
     * @var User Объект пользователя
     */
    private User $user;

    public function __construct()
    {
        $this->c_user = new CUser;
    }

    /**
     * Возвращает пользователя по ID
     * @param int $userId ID пользователя
     * @return User|null
     */
    public function get(int $userId): ?User
    {
        $this->user = new User($userId);
        return $this->user;
    }

    /**
     * Возвращает текущего пользователя
     * @return User|null
     */
    public function getCurrent(): ?User
    {
        global $USER;
        return $USER->GetID() ? $this->get($USER->GetID()) : null;
    }

    /**
     * Возвращает активного пользователя по его ID
     * @param int $userId
     * @return CUser|null
     */
    public function getActive(int $userId): ?User
    {
        $user = $this->get($userId);

        if (!$user || $user->active === 'N') {
            return null;
        }

        return $user;
    }

    public function activate(int $userId): bool
    {
        if ($this->update($userId, ['ACTIVE' => 'Y'])) {
            return $this->c_user->Authorize($userId);
        }
        return false;
    }

    public function update(int $userId, array $fields): bool
    {
        return $this->c_user->Update($userId, $fields);
    }
}