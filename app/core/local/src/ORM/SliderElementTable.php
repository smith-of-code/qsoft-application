<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;

Loc::loadMessages(__FILE__);

final class SliderElementTable extends BaseTable
{
    protected static array $decorators = [
        'UF_TYPE' => EnumDecorator::class,
    ];

    public static function getTableName(): string
    {
        return 'slider_element';
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
                'title' => Loc::getMessage('SLIDER_ELEMENT_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_SLIDER_ID', [
                'required' => true,
                'title' => Loc::getMessage('SLIDER_ELEMENT_ENTITY_UF_SLIDER_ID_FIELD'),
            ]),
            new EnumField('UF_TYPE', [
                'required' => true,
                'title' => Loc::getMessage('SLIDER_ELEMENT_ENTITY_UF_TYPE_FIELD'),
            ], self::getTableName()),
            new IntegerField('UF_ELEMENT_ID', [
                'required' => true,
                'title' => Loc::getMessage('SLIDER_ELEMENT_ENTITY_UF_ELEMENT_ID_FIELD'),
            ]),
        ];
    }
}
