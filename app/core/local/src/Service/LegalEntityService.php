<?php

namespace QSoft\Service;

use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\ORM\Data\UpdateResult;
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
                '=UF_IS_ACTIVE' => true
            ],
        ]);

        if ($legalEntity['UF_DOCUMENTS'] != '') {
            $legalEntity['DOCUMENTS'] = json_decode($legalEntity['UF_DOCUMENTS'], true, 512, JSON_THROW_ON_ERROR);
        }

        return $legalEntity;
    }

    /**
     * @param array $fields
     * 
     * @return UpdateResult
     */
    public function update(array $fields): UpdateResult
    {
        $legalEntity = LegalEntityTable::update($this->user->id, $fields);

        return $legalEntity;
    }

    /**
     * @param array $fields
     * 
     * @return AddResult
     */
    public function create(array $fields): AddResult
    {
        $legalEntity = LegalEntityTable::add($fields);

        return $legalEntity;
    }
}