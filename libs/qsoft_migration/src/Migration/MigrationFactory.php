<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 10.08.15
 * Time: 16:37
 */

namespace QSoft\Migration;

use QSoft\Migration\Creators\TableMigrationCreator;

abstract class MigrationFactory
{
    /**
     * @param $creator
     * @param bool $force_table
     * @return MigrationCreator
     */
    public static function factory($creator, $force_table = false)
    {
        $class = __NAMESPACE__.'\\Creators\\'.ucfirst(camel_case($creator)).'MigrationCreator';

        if (!class_exists($class) || $force_table) {
            return new TableMigrationCreator($creator);
        }

        return new $class;
    }
}