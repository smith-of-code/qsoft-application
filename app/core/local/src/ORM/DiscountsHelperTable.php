<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

final class DiscountsHelperTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'discounts_helper';
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
                'title' => 'ID',
            ]),
            new IntegerField('UF_DISCOUNT_ID', [
                'required' => true,
                'title' => 'ID правила работы с корзиной',
            ]),
            new StringField('UF_LINK', [
                'title' => 'Ссылка',
            ]),
            new IntegerField('UF_IMAGE', [
                'title' => 'Изображение',
            ]),
            new IntegerField('UF_AMOUNT', [
                'title' => 'Размер скидки',
            ]),
        ];
    }
}
