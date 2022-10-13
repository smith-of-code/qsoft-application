<?php

namespace QSoft\Service;

use QSoft\Entity\User;
use QSoft\ORM\PetTable;

class PetService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get(): ?array
    {
        $res = PetTable::getList([
            'filter' => [
                'UF_USER_ID' => $this->user->id,
            ],
        ]);
        while ($pet = $res->Fetch()){
            $pets[] = $pet;
        }

        return $pets;
    }
}