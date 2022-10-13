<?php

namespace QSoft\Service;

use QSoft\Entity\User;
use QSoft\ORM\LegalEntityTable;
use QSoft\Helper\HLPropertyHelper;

class LegalEntityService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get(): ?array
    {
        $legalEntity = LegalEntityTable::getRow([
            'order' => ['ID' => 'DESC'],
            'filter' => [
                '=UF_USER_ID' => $this->user->id,
                '=UF_IS_ACTIVE' => 1
            ],
        ]);

        if ($legalEntity['UF_DOCUMENTS'] != '') {
            $legalEntity['DOCUMENTS'] = json_decode($legalEntity['UF_DOCUMENTS'], true, 512, JSON_THROW_ON_ERROR);
        }

        return $legalEntity;
    }
}