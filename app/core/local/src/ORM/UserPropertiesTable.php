<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\BooleanField;
use Bitrix\Main\Entity\DateField;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\TextField;
use Bitrix\Main\SystemException;

class UserPropertiesTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'b_uts_user';
    }

    /**
     * @throws SystemException
     */
    public static function getMap(): array
    {
        return [
            new IntegerField('VALUE_ID', [
                'primary' => true,
            ]),
            new TextField('UF_IM_SEARCH',),
            new BooleanField('UF_AGREE_WITH_PERSONAL_DATA_PROCESSING'),
            new BooleanField('UF_AGREE_WITH_TERMS_OF_USE'),
            new BooleanField('UF_AGREE_WITH_COMPANY_RULES'),
            new BooleanField('UF_AGREE_TO_RECEIVE_INFORMATION_ABOUT_PROMOTIONS'),
            new IntegerField('UF_MENTOR_ID'),
            new IntegerField('UF_BONUS_POINTS'),
            new DateField('UF_LOYALTY_CHECK_DATE'),
            new IntegerField('UF_PICKUP_POINT_ID'),
            new IntegerField('UF_LOYALTY_LEVEL'),
            new BooleanField('UF_NO_SECOND_NAME'),
        ];
    }
}