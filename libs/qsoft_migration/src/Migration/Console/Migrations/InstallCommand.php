<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 05.08.15
 * Time: 20:01
 */

namespace QSoft\Migration\Console\Migrations;


use QSoft\Database\ConnectionResolver;
use QSoft\Migration\DatabaseIdentifyRepository;
use QSoft\Migration\DatabaseMigrationRepository;
use QSoft\Foundation\Console\Commands\BaseCommand;

class InstallCommand extends BaseCommand
{
    /**
     * The repository instance.
     *
     * @var \Illuminate\Database\Migrations\MigrationRepositoryInterface
     */
    protected $repository;

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

        $this->repository = new DatabaseMigrationRepository(
            new ConnectionResolver(),
            env('MIGRATION_TABLE', 'migrations')
        );

        $this->identifyRepository = new DatabaseIdentifyRepository(
            new ConnectionResolver(),
            env('MIGRATION_IDENTIFY_TABLE', 'migration_identify')
        );
    }

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('migrate:install');
        $this->setDescription('Create the migration repository');
    }

    function fire()
    {
        $this->repository->createRepository();
        $this->identifyRepository->createRepository();

        $this->output->writeln('<info>Migration table created successfully.</info>');
    }


}
