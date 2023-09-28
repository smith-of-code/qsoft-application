<?php

namespace QSoft\Queue\ORM;

use Bitrix\Main;

class FailedJobTable extends Main\Entity\DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'failed_jobs';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            'id' => [
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
            ],
            'connection' => [
                'data_type' => 'text',
            ],
            'queue' => [
                'data_type' => 'text',
            ],
            'payload' => [
                'data_type' => 'text',
            ],
            'exception' => [
                'data_type' => 'text',
            ],
            'failed_at' => [
                'data_type' => 'datetime',
            ],
        ];
    }
}
