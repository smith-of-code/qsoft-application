<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;
use QSoft\ORM\Traits\HasHighloadEnums;

Loc::loadMessages(__FILE__);

class SliderElementTable extends Entity\DataManager
{
    use HasHighloadEnums;

    public static function getTableName(): string
    {
        return 'slider_element';
    }

    public static function getMap(): array
    {
        $data = self::getEnumValues(self::getTableName(), ['UF_TYPE']);

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
                'values' => $data['UF_TYPE'],
                'title' => Loc::getMessage('SLIDER_ELEMENT_ENTITY_UF_TYPE_FIELD'),
            ]),
            new Entity\IntegerField('UF_ELEMENT_ID', [
                'required' => true,
                'title' => Loc::getMessage('SLIDER_ELEMENT_ENTITY_UF_ELEMENT_ID_FIELD'),
            ]),
        ];
    }
}
