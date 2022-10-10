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
            // Получим сведения о UF-поле объекта
            $res = UserFieldHelper::getUserField('HLBLOCK_' . $this->hlId, 'UF_TYPE');
            if ($res) {
                // Получим значения UF-поля объекта
                $vals = UserFieldHelper::getUserFieldEnumValues($res['ID']);
                foreach ($vals as $val) {
                    $this->types[$val['XML_ID']] = $val['ID'];
                }
            }
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
            // Получим сведения о UF-поле объекта
            $res = UserFieldHelper::getUserField('HLBLOCK_' . $this->hlId, 'UF_SOURCE');
            if ($res) {
                // Получим значения UF-поля объекта
                $vals = UserFieldHelper::getUserFieldEnumValues($res['ID']);
                foreach ($vals as $val) {
                    $this->sources[$val['XML_ID']] = $val['ID'];
                }
            }
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
            // Получим сведения о UF-поле объекта
            $res = UserFieldHelper::getUserField('HLBLOCK_' . $this->hlId, 'UF_MEASURE');
            if ($res) {
                // Получим значения UF-поля объекта
                $vals = UserFieldHelper::getUserFieldEnumValues($res['ID']);
                foreach ($vals as $val) {
                    $this->measures[$val['XML_ID']] = $val['ID'];
                }
            }
        }
        return $this->measures;
    }
}