<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 05.08.15
 * Time: 20:01
 */

namespace QSoft\Migration\Console\Migrations;

use QSoft\Database\ConnectionResolver;
use QSoft\Migration\DatabaseMigrationRepository;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Filesystem\Filesystem;
use QSoft\Foundation\Console\Commands\BaseCommand;

class ResetCommand extends BaseCommand
{
    /**
     * The migrator instance.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected $migrator;

    /**
     * Constructor.
     *
     * @param string|null $name The name of the command; passing null means it must be set in configure()
     *
     * @throws \LogicException When the command name is empty
     *
     * @api
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->migrator = new Migrator(
            new DatabaseMigrationRepository(
                new ConnectionResolver(),
                env('MIGRATION_TABLE', 'migrations')
            ),
            new ConnectionResolver(),
            new Filesystem()
        );

    }

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('migrate:reset');
        $this->setDescription('Rollback all database migrations');
    }

    public function fire()
    {
        if (! $this->migrator->repositoryExists()) {
            $this->output->writeln('<comment>Migration table not found.</comment>');
            return;
        }

        $this->migrator->reset();

        foreach ($this->migrator->getNotes() as $note) {
            $this->output->writeln($note);
        }
    }
}