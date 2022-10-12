<?php

namespace QSoft\Service;

use QSoft\Entity\User;
use Bitrix\Highloadblock\HighloadBlockTable as HL;

class PetService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get(): ?array
    {
        $arPets = [];

        $hlBlock = HL::getList([
            'filter' => ['=ID' => HIGHLOAD_BLOCK_HLPETS],
        ])->fetch();

        $resPets = HL::compileEntity($hlBlock)->getDataClass()::getList([
            'filter' => [
                'UF_USER_ID' => $this->user->id,
            ],
        ]);
        while ($pet = $resPets->Fetch()){
            $arPets[] = $pet;
        }

        return $arPets;
    }
}