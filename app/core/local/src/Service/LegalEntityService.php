<?php

namespace QSoft\Service;

use QSoft\Entity\User;
use Bitrix\Highloadblock\HighloadBlockTable as HL;

class LegalEntityService
{
    private User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function get(): ?array
    {
        $hlBlock = HL::getList([
            'filter' => ['=ID' => HIGHLOAD_BLOCK_HLLEGALENTITIES],
        ])->fetch();

        $arLegalEntity = HL::compileEntity($hlBlock)->getDataClass()::getList([
            'order' => ['ID' => 'DESC'],
            'filter' => [
                'UF_USER_ID' => $this->user->id,
                'UF_IS_ACTIVE' => 1
            ],
        ])->fetch();

        if ($arLegalEntity['UF_DOCUMENTS'] != '') {
            $arLegalEntity['DOCUMENTS'] = json_decode($arLegalEntity['UF_DOCUMENTS'], true, 512, JSON_THROW_ON_ERROR);
        }

        return $arLegalEntity;
    }
}