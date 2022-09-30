<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

final class RelatedProductTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'related_product';
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
                'title' => Loc::getMessage('RELATED_PRODUCT_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_MAIN_PRODUCT_ID', [
                'required' => true,
                'title' => Loc::getMessage('RELATED_PRODUCT_ENTITY_UF_MAIN_PRODUCT_ID_FIELD'),
            ]),
            new IntegerField('UF_RELATED_PRODUCT_ID', [
                'required' => true,
                'title' => Loc::getMessage('RELATED_PRODUCT_ENTITY_UF_RELATED_PRODUCT_ID_FIELD'),
            ]),
        ];
    }
}
