<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\ORM\Data\UpdateResult;
use QSoft\ORM\Decorators\DecoratorInterface;

abstract class BaseTable extends DataManager
{
    /**
     * @var DecoratorInterface[]
     */
    protected static array $decorators = [];

    final public static function add(array $data): AddResult
    {
        return parent::add(static::prepareFields($data));
    }

    final public static function addMulti($rows, $ignoreEvents = false): AddResult
    {
        return parent::addMulti(array_map(static fn ($row) => static::prepareFields($row), $rows), $ignoreEvents);
    }

    final public static function update($primary, array $data): UpdateResult
    {
        return parent::update($primary, static::prepareFields($data));
    }

    final public static function updateMulti($primaries, $data, $ignoreEvents = false): UpdateResult
    {
        return parent::updateMulti(
            $primaries,
            array_map(static fn ($item) => static::prepareFields($item), $data),
            $ignoreEvents
        );
    }

    final protected static function prepareFields(array $fields): array
    {
        foreach ($fields as $fieldName => &$fieldValue) {
            if (static::$decorators[$fieldName]) {
                $fieldValue = static::$decorators[$fieldName]::prepareField($fieldName, $fieldValue);
            }
        }
        return $fields;
    }
}
