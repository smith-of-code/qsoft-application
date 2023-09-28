<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 05.08.15
 * Time: 18:17
 */

namespace QSoft\Migration;

class DatabaseMigrationRepository extends \Illuminate\Database\Migrations\DatabaseMigrationRepository
{
    /**
     * Create the migration repository data store.
     *
     * @return void
     */
    public function createRepository()
    {
        if ($this->repositoryExists()) return;

        parent::createRepository();
    }

}