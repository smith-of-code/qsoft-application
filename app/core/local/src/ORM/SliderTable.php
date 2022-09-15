<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class SliderTable extends Entity\DataManager
{
    public static function getTableName(): string
    {
        return 'slider';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('SLIDER_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_TITLE', [
                'required' => true,
                'title' => Loc::getMessage('SLIDER_ENTITY_UF_TITLE_FIELD'),
            ]),
        ];
    }
}
