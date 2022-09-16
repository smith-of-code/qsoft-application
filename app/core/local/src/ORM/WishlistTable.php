<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class WishlistTable extends Entity\DataManager
{
    public static function getTableName(): string
    {
        return 'wishlist';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('WISHLIST_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('WISHLIST_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_PRODUCT_ID', [
                'required' => true,
                'title' => Loc::getMessage('WISHLIST_ENTITY_UF_PRODUCT_ID_FIELD'),
            ]),
        ];
    }
}
