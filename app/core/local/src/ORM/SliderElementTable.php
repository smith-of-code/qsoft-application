<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class SliderElementTable extends Entity\DataManager
{
    const TYPES = [
        'BANNER',
        'PRODUCT',
    ];

    public static function getTableName(): string
    {
        return 'slider_element';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('SLIDER_ELEMENT_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_SLIDER_ID', [
                'required' => true,
                'title' => Loc::getMessage('SLIDER_ELEMENT_ENTITY_UF_SLIDER_ID_FIELD'),
            ]),
            new Entity\EnumField('UF_TYPE', [
                'required' => true,
                'values' => self::TYPES,
                'title' => Loc::getMessage('SLIDER_ELEMENT_ENTITY_UF_TYPE_FIELD'),
            ]),
            new Entity\IntegerField('UF_ELEMENT_ID', [
                'required' => true,
                'title' => Loc::getMessage('SLIDER_ELEMENT_ENTITY_UF_ELEMENT_ID_FIELD'),
            ]),
        ];
    }
}
