<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 10.08.15
 * Time: 16:45
 */

namespace QSoft\Migration\Creators;


use Bitrix\Main\DB\Exception;
use QSoft\Migration\Builder\CreateOptionBuilder;
use QSoft\Migration\MigrationCreator;

class IblockTypeMigrationCreator extends MigrationCreator
{
    public function getBuilder($method)
    {
        $class = '\\QSoft\\Migration\\Builder\\'.ucfirst($method).'IblockTypeBuilder';
        return new $class();
    }
}