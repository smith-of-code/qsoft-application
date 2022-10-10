<?php

namespace QSoft\Service;

use CUserFieldEnum;
use Bitrix\Highloadblock\HighloadBlockTable;
use http\Exception\RuntimeException;
use QSoft\Entity\User;
use QSoft\Helper\UserFieldHelper;
use QSoft\ORM\TransactionTable;

class TransactionsService
{
    private User $user;
    private int $hlId;
    /**
     * @var array Типы транзакций [XML_ID => ID]
     */
    private array $types;
    /**
     * @var array Источники транзакций [XML_ID => ID]
     */
    private array $sources;
    /**
     * @var array Единицы измерения стоимости транзакций [XML_ID => ID]
     */
    private array $measures;

    /**
     * TransactionsService constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
        $this->hlId = HIGHLOAD_BLOCK_HLTRANSACTION;
        if (! isset($this->hlId)) {
            throw new RuntimeException('Не задана константа HIGHLOAD_BLOCK_HLTRANSACTION');
        }
    }

    /**
     * Получает идентификаторы значений поля UF_TYPE
     * @return array Массив с парами [XML_ID => ID]
     */
    public function getTypesIds() : array
    {
        if (empty($this->types)) {
            $this->types = UserFieldHelper::getUserFieldEnumValuesIds('HLBLOCK_' . $this->hlId, 'UF_TYPE');
        }
        return $this->types;
    }

    /**
     * Получает идентификаторы значений поля UF_SOURCE
     * @return array Массив с парами [XML_ID => ID]
     */
    public function getSourcesIds() : array
    {
        if (empty($this->sources)) {
            $this->sources = UserFieldHelper::getUserFieldEnumValuesIds('HLBLOCK_' . $this->hlId, 'UF_SOURCE');
        }
        return $this->sources;
    }

    /**
     * Получает идентификаторы значений поля UF_MEASURE
     * @return array Массив с парами [XML_ID => ID]
     */
    public function getMeasuresIds() : array
    {
        if (empty($this->measures)) {
            $this->measures = UserFieldHelper::getUserFieldEnumValuesIds('HLBLOCK_' . $this->hlId, 'UF_MEASURE');
        }
        return $this->measures;
    }
}