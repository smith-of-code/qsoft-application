<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class RelatedProductTable extends Entity\DataManager
{
    public static function getTableName(): string
    {
        return 'related_product';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('RELATED_PRODUCT_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_MAIN_PRODUCT_ID', [
                'required' => true,
                'title' => Loc::getMessage('RELATED_PRODUCT_ENTITY_UF_MAIN_PRODUCT_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_RELATED_PRODUCT_ID', [
                'required' => true,
                'title' => Loc::getMessage('RELATED_PRODUCT_ENTITY_UF_RELATED_PRODUCT_ID_FIELD'),
            ]),
        ];
    }
}
