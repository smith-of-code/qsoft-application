<?php

namespace QSoft\Service;

use QSoft\Entity\User;
use QSoft\ORM\BeneficiariesTable;

class BeneficiariesService
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}