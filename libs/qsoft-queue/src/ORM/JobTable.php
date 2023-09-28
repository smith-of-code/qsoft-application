<?php

namespace QSoft\Queue\ORM;

use Bitrix\Main;

class JobTable extends Main\Entity\DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'jobs';
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
            'queue' => [
                'data_type' => 'string',
                'validation' => [__CLASS__, 'validateQueue'],
            ],
            'payload' => [
                'data_type' => 'text',
            ],
            'attempts' => [
                'data_type' => 'integer',
            ],
            'reserved' => [
                'data_type' => 'integer',
            ],
            'reserved_at' => [
                'data_type' => 'integer',
            ],
            'available_at' => [
                'data_type' => 'integer',
            ],
            'created_at' => [
                'data_type' => 'integer',
            ],
        ];
    }

    /**
     * Returns validators for queue field.
     *
     * @return array
     */
    public static function validateQueue()
    {
        return array(
            new Main\Entity\Validator\Length(null, 255),
        );
    }
}
