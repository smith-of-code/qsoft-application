<?php

namespace QSoft\Service;

use CUser;
use QSoft\Entity\User;

class UserService
{
    /**
     * @var CUser ������ ������������ ��������
     */
    private CUser $c_user;
    /**
     * @var User ������ ������������
     */
    private User $user;

    public function __construct()
    {
        $this->c_user = new CUser;
    }

    /**
     * ���������� ������������ �� ID
     * @param int $userId ID ������������
     * @return User|null
     */
    public function get(int $userId): ?User
    {
        $this->user = new User($userId);
        return $this->user;
    }

    /**
     * ���������� �������� ������������
     * @return User|null
     */
    public function getCurrent(): ?User
    {
        global $USER;
        return $USER->GetID() ? $this->get($USER->GetID()) : null;
    }

    /**
     * ���������� ��������� ������������ �� ��� ID
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