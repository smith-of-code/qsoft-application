<?php

namespace QSoft\Service;

use QSoft\Entity\User;

class TeamService
{
    private User $user;

    /**
     * TeamService constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }


    public function getUsers() {

    }
}