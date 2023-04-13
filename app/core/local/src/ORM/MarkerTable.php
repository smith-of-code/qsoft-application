<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use QSoft\Helper\ColorHelper;

Loc::loadMessages(__FILE__);

final class MarkerTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'marker';
    }

    public static function getMap(): array
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('MARKER_ENTITY_ID_FIELD'),
            ]),
            new StringField('UF_NAME', [
                'required' => true,
                'title' => Loc::getMessage('MARKER_ENTITY_UF_NAME_FIELD'),
            ]),
            new \Bitrix\Main\ORM\Fields\StringField('UF_XML_ID', [
                'required' => true,
                'title' => Loc::getMessage('MARKER_ENTITY_UF_XML_ID_FIELD'),
            ]),
            new \Bitrix\Main\ORM\Fields\IntegerField('UF_COLOR', [
                'required' => true,
                'title' => Loc::getMessage('MARKER_ENTITY_UF_COLOR_FIELD'),
            ]),
            new Reference('UF_COLOR_NAME',
                ColorHelper::getTable(),
                Join::on('this.UF_COLOR', 'ref.ID')
            )
        ];
    }
}
