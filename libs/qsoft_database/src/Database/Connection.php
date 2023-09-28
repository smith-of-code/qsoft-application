<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 19.04.15
 * Time: 15:21
 */

namespace QSoft\Database;


use Bitrix\Main\DB\Connection as BitrixConnection;
use Closure;
use QSoft\Database\Query\Builder as QueryBuilder;
use QSoft\Database\Exception\QueryException;
use Illuminate\Database\MySqlConnection as IlluminateMysqlConnection;

class Connection extends IlluminateMysqlConnection {

    /**
     * @var BitrixConnection
     */
    private $connection;

    public function __construct(BitrixConnection $connection)
    {
        $this->connection = $connection;

        $this->useDefaultQueryGrammar();
        $this->useDefaultPostProcessor();
    }

    protected function getDefaultSchemaGrammar()
    {
        return new \Illuminate\Database\Schema\Grammars\MySqlGrammar();
    }

    /**
     * Get the name of the connected database.
     *
     * @return string
     */
    public function getDatabaseName()
    {
        return $this->connection->getDatabase();
    }

    /**
     * Run a select statement and return a single result.
     *
     * @param  string $query
     * @param  array $bindings
     * @return mixed
     */
    public function selectOne($query, $bindings = array(), $useReadPdo = true)
    {
        return $this->extQuery($this->prepareQuery($query, $bindings))->Fetch();
    }

    /**
     * Reconnect to the database if a PDO connection is missing.
     *
     * @return void
     */
    protected function reconnectIfMissingConnection()
    {
        if (!$this->connection->isConnected()) {
            $this->connection->connect();
        }
    }

    /**
     * Run a select statement against the database.
     *
     * @param  string $query
     * @param  array $bindings
     * @return array
     */
    public function select($query, $bindings = array(), $useReadPdo = true)
    {
        $result = array();
        $baseResult = $this->extQuery($this->prepareQuery($query, $bindings));

        while($resultItem = $baseResult->Fetch()) {
            $result[] = $resultItem;
        }

        return $result;
    }

    /**
     * Run an insert statement against the database.
     *
     * @param  string $query
     * @param  array $bindings
     * @return bool
     */
    public function insert($query, $bindings = array())
    {
        return $this->extQuery($this->prepareQuery($query, $bindings));
    }

    /**
     * Run an update statement against the database.
     *
     * @param  string $query
     * @param  array $bindings
     * @return int
     */
    public function update($query, $bindings = array())
    {
        return $this->extQuery($this->prepareQuery($query, $bindings));
    }

    /**
     * Run a delete statement against the database.
     *
     * @param  string $query
     * @param  array $bindings
     * @return int
     */
    public function delete($query, $bindings = array())
    {
        return $this->extQuery($this->prepareQuery($query, $bindings));
    }

    public function extQuery($prepareQueryString)
    {
        $query = $this->connection->query($prepareQueryString);

        if ($query === false) throw new QueryException($this->connection->db_Error);

        return $query;
    }

    private function prepareQuery($query, $bindings)
    {
        foreach ($bindings as &$bind) {

            switch (gettype($bind)) {
                case 'NULL':
                    $bind = 'NULL';
                    break;
                case 'integer':
                case 'boolean':
                    $bind = intval($bind);
                    break;
                case 'string':
                default:
                    $bind = "'".$this->connection->getSqlHelper()->forSql($bind)."'";
                    break;
            }
        }

        unset($bind);

        $query = str_replace('?', '%s', $query);
        array_unshift($bindings, $query);
        $query = call_user_func_array('sprintf', $bindings);

        return $query;
    }

    public function lastInsertId() {
        return $this->connection->getInsertedId();
    }

    public function getPdo() {
        return $this;
    }

    /**
     * Begin a fluent query against a database table.
     *
     * @param  string $table
     * @return \Illuminate\Database\Query\Builder
     */
    public function table($table)
    {
        $processor = $this->getPostProcessor();

        $query = new QueryBuilder($this, $this->getQueryGrammar(), $processor);

        return $query->from($table);
    }

    /**
     * Execute an SQL statement and return the boolean result.
     *
     * @param  string $query
     * @param  array $bindings
     * @return bool
     */
    public function statement($query, $bindings = [])
    {
        return $this->connection->query($query);
    }

    /**
     * Run an SQL statement and get the number of rows affected.
     *
     * @param  string $query
     * @param  array $bindings
     * @return int
     */
    public function affectingStatement($query, $bindings = [])
    {
        // TODO: Implement affectingStatement() method.
    }

    /**
     * Run a raw, unprepared query against the PDO connection.
     *
     * @param  string $query
     * @return bool
     */
    public function unprepared($query)
    {
        // TODO: Implement unprepared() method.
    }

    /**
     * Prepare the query bindings for execution.
     *
     * @param  array $bindings
     * @return array
     */
    public function prepareBindings(array $bindings)
    {
        // TODO: Implement prepareBindings() method.
    }

    /**
     * Start a new database transaction.
     *
     * @return void
     */
    public function beginTransaction()
    {
        ++$this->transactions;

        if ($this->transactions == 1)
        {
            try
            {
                $this->connection->startTransaction();
            }
            catch (\Exception $e)
            {
                --$this->transactions;

                throw $e;
            }
        }
        elseif ($this->transactions > 1 && $this->queryGrammar->supportsSavepoints())
        {
            $this->connection->queryExecute(
                $this->queryGrammar->compileSavepoint('trans'.$this->transactions)
            );
        }
    }

    /**
     * Commit the active database transaction.
     *
     * @return void
     */
    public function commit()
    {
        if ($this->transactions == 1)
        {
            $this->connection->commitTransaction();
        }

        --$this->transactions;
    }

    /**
     * Rollback the active database transaction.
     *
     * @return void
     */
    public function rollBack($toLevel = null)
    {
        $toLevel = is_null($toLevel)
            ? $this->transactions - 1
            : $toLevel;

        if ($toLevel == 0)
        {
            $this->connection->rollbackTransaction();
        }
        elseif ($toLevel > 1 && $this->queryGrammar->supportsSavepoints())
        {
            $this->connection->queryExecute(
                $this->queryGrammar->compileSavepointRollBack('trans'.($toLevel + 1))
            );
        }

        $this->transactions = max(0, $toLevel);
    }

//    /**
//     * Execute the given callback in "dry run" mode.
//     *
//     * @param  \Closure $callback
//     * @return array
//     */
//    public function pretend(Closure $callback)
//    {
//        // TODO: Implement pretend() method.
//    }
    public function cursor($query, $bindings = [], $useReadPdo = true)
    {
        $statement = $this->extQuery($this->prepareQuery($query, $bindings));

        while ($record = $statement->fetch()) {
            yield $record;
        }
    }
}