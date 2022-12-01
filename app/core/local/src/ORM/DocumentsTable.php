<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

final class DocumentsTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'documents';
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
            new StringField('UF_NAME', [
                'required' => true,
                'title' => 'Название',
            ]),
            new IntegerField('UF_DOCUMENT', [
                'required' => true,
                'title' => 'Документ',
            ]),
        ];
    }
}
