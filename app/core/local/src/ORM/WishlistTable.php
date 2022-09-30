<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

final class WishlistTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'wishlist';
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
                'title' => Loc::getMessage('WISHLIST_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('WISHLIST_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new IntegerField('UF_PRODUCT_ID', [
                'required' => true,
                'title' => Loc::getMessage('WISHLIST_ENTITY_UF_PRODUCT_ID_FIELD'),
            ]),
        ];
    }
}
