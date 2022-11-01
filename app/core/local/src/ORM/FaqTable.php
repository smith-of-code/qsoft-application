<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\DateField;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;

Loc::loadMessages(__FILE__);

final class FaqTable extends BaseTable
{
    protected static array $decorators = [
        'UF_GROUP' => EnumDecorator::class,
    ];

    public static function getTableName(): string
    {
        return 'faq';
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
                'title' => Loc::getMessage('FAQ_ENTITY_ID_FIELD'),
            ]),
            new EnumField('UF_GROUP', [
                'required' => true,
                'title' => Loc::getMessage('FAQ_ENTITY_UF_GROUP_FIELD'),
            ], self::getTableName()),
            new StringField('UF_QUESTION', [
                'required' => true,
                'title' => Loc::getMessage('FAQ_ENTITY_UF_QUESTION_FIELD'),
            ]),
            new StringField('UF_ANSWER', [
                'required' => true,
                'title' => Loc::getMessage('FAQ_ENTITY_UF_ANSWER_FIELD'),
            ]),
        ];
    }
}
