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

class OptionMigrationCreator extends MigrationCreator
{
    public function getBuilder($method)
    {
        return new CreateOptionBuilder();
    }
}