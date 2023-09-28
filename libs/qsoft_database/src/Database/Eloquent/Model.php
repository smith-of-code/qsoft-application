<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 04.07.15
 * Time: 0:22
 */

namespace QSoft\Database\Eloquent;



use Fifa2018\Database\Connection;
use Fifa2018\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\MySqlGrammar;
use Illuminate\Database\Query\Processors\MySqlProcessor;

abstract class Model extends \Illuminate\Database\Eloquent\Model {


    protected function newBaseQueryBuilder()
    {
        return new Builder(new Connection(), new MySqlGrammar(), new MySqlProcessor());
    }


}