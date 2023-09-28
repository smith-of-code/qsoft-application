<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 19.04.15
 * Time: 15:21
 */

namespace QSoft\Database;

use Bitrix\Main\DB\MysqlCommonConnection;
use Illuminate\Database\Query\Grammars\MySqlGrammar;
use Illuminate\Database\Query\Processors\MySqlProcessor;
use Illuminate\Database\Schema\Grammars\MySqlGrammar as SchemaGrammar;

class MysqlConnection extends Connection {

    /**
     * Get the default query grammar instance.
     *
     * @return \Illuminate\Database\Query\Grammars\MySqlGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new MySqlGrammar());
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return SchemaGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new SchemaGrammar());
    }

    /**
     * Get the default post processor instance.
     *
     * @return \Illuminate\Database\Query\Processors\Processor
     */
    protected function getDefaultPostProcessor()
    {
        return new MySqlProcessor;
    }

}