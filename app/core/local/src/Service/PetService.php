<?php

namespace QSoft\Service;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use QSoft\Entity\User;
use QSoft\ORM\PetTable;

class PetService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll(): array
    {
        $res = PetTable::getList([
            'filter' => [
                'UF_USER_ID' => $this->user->id,
            ],
        ]);

        $pets = [];
        while ($pet = $res->Fetch()){
            $pets[] = $pet;
        }

        return $pets;
    }

    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
    public function get(int $petId): ?array
    {
        return PetTable::getRowById($petId);
    }
}