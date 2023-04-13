<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

final class SliderTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'slider';
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
                'title' => Loc::getMessage('SLIDER_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_TITLE', [
                'required' => true,
                'title' => Loc::getMessage('SLIDER_ENTITY_UF_TITLE_FIELD'),
            ]),
        ];
    }
}
