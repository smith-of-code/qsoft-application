<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 10.08.15
 * Time: 16:45
 */

namespace QSoft\Migration\Creators;

use QSoft\Migration\MigrationCreator;
use TwigGenerator\Builder\BuilderInterface;

class UserOptionMigrationCreator extends MigrationCreator
{
    public function getBuilder($method)
    {
        $class = '\\QSoft\\Migration\\Builder\\'.ucfirst($method).'UserOptionBuilder';
        return new $class();
    }

}