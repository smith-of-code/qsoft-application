<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 10.08.15
 * Time: 16:45
 */

namespace QSoft\Migration\Creators;


use Bitrix\Main\DB\Exception;
use QSoft\Migration\MigrationCreator;
use TwigGenerator\Builder\BuilderInterface;

class TableMigrationCreator extends MigrationCreator
{
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
        parent::__construct();
    }

    protected function generate(BuilderInterface $builder, $data)
    {
        $data['table_name'] = $this->table;

        return parent::generate($builder, $data);
    }


    public function getBuilder($method)
    {
        $class = '\\QSoft\\Migration\\Builder\\'.ucfirst($method).'TableBuilder';
        return new $class;
    }
}