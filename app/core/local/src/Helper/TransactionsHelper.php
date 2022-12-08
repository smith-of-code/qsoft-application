<?php

namespace QSoft\Helper;

use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\Type\DateTime;
use Bitrix\Highloadblock\HighloadBlockTable;
use QSoft\Entity\User;
use QSoft\Helper\UserFieldHelper;
use QSoft\ORM\TransactionTable;
use RuntimeException;

class TransactionsHelper
{
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

    public function __construct() {
        $this->hlId = HIGHLOAD_BLOCK_HLTRANSACTION; //.const
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

    /**
     * Добавляет запись в HL Транзакции
     * @param int $userId ID пользователя
     * @param $type string Тип транзакции (символьный код)
     * @param $source string Источник транзакции (символьный код)
     * @param $measure string Мера значения суммы транзакции (символьный код)
     * @param $amount numeric Сумма транзакции
     * @return AddResult
     * @throws \Exception
     */
    public function add(int $userId, string $type, string $source, string $measure, float $amount, ?int $orderId = null): AddResult
    {
        return TransactionTable::add([
            'UF_USER_ID' => $userId,
            'UF_CREATED_AT' => new DateTime,
            'UF_TYPE' => $type,
            'UF_SOURCE' => $source,
            'UF_MEASURE' => $measure,
            'UF_AMOUNT' => $amount,
            'UF_ORDER_ID' => $orderId,
        ]);
    }
}