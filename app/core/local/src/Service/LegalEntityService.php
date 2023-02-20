<?php

namespace QSoft\Service;

use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\ORM\Data\UpdateResult;
use Psr\Log\LogLevel;
use QSoft\Entity\User;
use QSoft\Helper\HlBlockHelper;
use QSoft\Logger\Logger;
use QSoft\ORM\LegalEntityTable;

class LegalEntityService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getData(): array
    {
        if (!$this->user->groups->isConsultant()) {
            $error = new \RuntimeException('User is not a consultant');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);
 
            throw $error;
        }
        $types = HlBlockHelper::getPreparedEnumFieldValues(LegalEntityTable::getTableName(), 'UF_STATUS');

        $legalEntity = LegalEntityTable::getRow([
            'order' => ['ID' => 'DESC'],
            'filter' => [
                '=UF_USER_ID' => $this->user->id,
                '=UF_IS_ACTIVE' => true
            ],
        ]);

        if (!in_array($types[$legalEntity['UF_STATUS']]['code'], LegalEntityTable::STATUSES)) {
            $error = new \RuntimeException('Unknown legal entity status');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);
 
            throw $error;
        }

        return [
            'id' => $legalEntity['ID'],
            'user_id' => $legalEntity['UF_USER_ID'],
            'type' => $types[$legalEntity['UF_STATUS']],
            'active' => $legalEntity['UF_IS_ACTIVE'],
            'documents' => json_decode($legalEntity['UF_DOCUMENTS'], true, 512, JSON_THROW_ON_ERROR),
        ];
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