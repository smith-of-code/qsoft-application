<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 10.08.15
 * Time: 17:28
 */

namespace QSoft\Migration;

use Illuminate\Database\ConnectionResolverInterface as Resolver;
use Illuminate\Database\Schema\Blueprint;
use Rhumsaa\Uuid\Uuid;

class DatabaseIdentifyRepository
{
    /**
     * The database connection resolver instance.
     *
     * @var \Illuminate\Database\ConnectionResolverInterface
     */
    protected $resolver;

    /**
     * The name of the migration table.
     *
     * @var string
     */
    protected $table;

    /**
     * The name of the database connection to use.
     *
     * @var string
     */
    protected $connection;

    /**
     * Create a new database migration repository instance.
     *
     * @param  \Illuminate\Database\ConnectionResolverInterface  $resolver
     * @param  string  $table
     * @return void
     */
    public function __construct(Resolver $resolver, $table)
    {
        $this->table = $table;
        $this->resolver = $resolver;
    }

    /**
     * Determine if the migration repository exists.
     *
     * @return bool
     */
    public function repositoryExists()
    {
        $schema = $this->getConnection()->getSchemaBuilder();

        return $schema->hasTable($this->table);
    }

    /**
     * Create the migration repository data store.
     *
     * @return void
     */
    public function createRepository()
    {
        if ($this->repositoryExists()) return;

        $schema = $this->getConnection()->getSchemaBuilder();

        $schema->create($this->table, function (Blueprint $table) {
            // The migrations table is responsible for keeping track of which of the
            // migrations have actually run for the application. We'll create the
            // table to hold the migration file's path as well as the batch ID.
            $table->char('id', 36);
            $table->char('entity', 100);
            $table->integer('real_id', false, true);

            $table->primary('id');
        });
    }

    public function registerIdentity($consolidatedId, $realId, $entityType) {

        $record = ['id' => $consolidatedId, 'entity' => $entityType, 'real_id' => $realId];

        if (is_null($this->table()->where('id', $consolidatedId)->first()))
            return $this->table()->insert($record);

        return $this->table()->where('id', $consolidatedId)->update(array_except($record, ['id']));
    }

    public function generateId() {
        return Uuid::uuid1();
    }

    /**
     * Get the next migration batch number.
     *
     * @return int
     */
    public function getNextBatchNumber()
    {
        return $this->getLastBatchNumber() + 1;
    }

    /**
     * Get the last migration batch number.
     *
     * @return int
     */
    public function getLastBatchNumber()
    {
        return $this->table()->max('batch');
    }

    /**
     * Get a query builder for the migration table.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function table()
    {
        return $this->getConnection()->table($this->table);
    }

    /**
     * Get the connection resolver instance.
     *
     * @return \Illuminate\Database\ConnectionResolverInterface
     */
    public function getConnectionResolver()
    {
        return $this->resolver;
    }

    /**
     * Resolve the database connection instance.
     *
     * @return \Illuminate\Database\Connection
     */
    public function getConnection()
    {
        return $this->resolver->connection($this->connection);
    }

    /**
     * Set the information source to gather data.
     *
     * @param  string  $name
     * @return void
     */
    public function setSource($name)
    {
        $this->connection = $name;
    }

    public function getRealId($consolidatedId, $type)
    {
        $record = $this->table()
            ->where('id', (string)$consolidatedId)
            ->where('entity', $type)
            ->first();

        return $record ? $record['real_id'] : null;
    }

    public function getRealIdOrDefault($consolidatedId, $defaultId, $type) {
        return $this->getRealId($consolidatedId, $type) ?: $defaultId;
    }

    public function getConsolidatedIdentity($realId, $type)
    {
        $record = $this->table()
            ->where('real_id', $realId)
            ->where('entity', $type)
            ->first();

        return $record ? $record['id'] : null;
    }

}