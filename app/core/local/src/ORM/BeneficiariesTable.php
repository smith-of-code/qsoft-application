<?php

namespace QSoft\ORM;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;

class BeneficiariesTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'beneficiary';
    }

    /**
     * @throws SystemException
     */
    public static function getMap(): array
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new IntegerField('UF_USER_ID'),
            new IntegerField('UF_BENEFICIARY_ID'),
        ];
    }

    /**
     * @param int $userId
     * @return int|null
     * @throws SystemException
     * @throws ArgumentException
     * @throws ObjectPropertyException
     */
    public static function getBeneficiaryId(int $userId): ?int
    {
        $row = self::getRow([
            'filter' => [
                '=UF_USER_ID' => $userId,
            ],
            'select' => ['ID', 'UF_BENEFICIARY_ID'],
        ]);

        return $row ? $row['UF_BENEFICIARY_ID'] : null;
    }

    /**
     * @param int|int[] $filter
     * @return int[]
     * @throws SystemException
     * @throws ArgumentException
     * @throws ObjectPropertyException
     */
    public static function getWardsIds($filter): array
    {
        return array_column(self::getList([
            'filter' => [
                '=UF_BENEFICIARY_ID' => $filter,
            ],
            'select' => ['ID', 'UF_USER_ID'],
        ])->fetchAll(), 'UF_USER_ID');
    }
}