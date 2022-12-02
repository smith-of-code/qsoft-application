<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;

Loc::loadMessages(__FILE__);

final class DocumentsTable extends BaseTable
{
    public const NAMES = [
        'cert' => 'CERT',
        'market_plan' => 'MARKET_PLAN',
        'consultants_list' => 'CONSULTANTS_LIST',
        'general_rules' => 'GENERAL_RULES',
        'clients' => 'RULES_AND_CONDITIONS_FOR_CLIENTS',
        'self_employed' => 'RULES_AND_CONDITIONS_FOR_SELF_EMPLOYED',
        'ip' => 'RULES_AND_CONDITIONS_FOR_IP',
        'ltc' => 'RULES_AND_CONDITIONS_FOR_LTC',
    ];

    protected static array $decorators = [
        'UF_NAME' => EnumDecorator::class,
    ];

    public static function getTableName(): string
    {
        return 'documents';
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
                'title' => 'ID',
            ]),
            new EnumField('UF_NAME', [
                'required' => true,
                'title' => 'Название',
            ], self::getTableName()),
            new IntegerField('UF_DOCUMENT', [
                'required' => true,
                'title' => 'Документ',
            ]),
        ];
    }
}
