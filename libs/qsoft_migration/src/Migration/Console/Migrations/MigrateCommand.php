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
use Illuminate\Filesystem\Filesystem;
use QSoft\Migration\Migrator;
use QSoft\Foundation\Console\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCommand extends BaseCommand
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

        $connectionResolver = new ConnectionResolver();

        $this->migrator = new Migrator(
            new DatabaseMigrationRepository(
                $connectionResolver,
                env('MIGRATION_TABLE', 'migrations')
            ),
            new DatabaseIdentifyRepository(
                $connectionResolver,
                env('MIGRATION_IDENTIFY_TABLE', 'migration_identify')
            ),
            $connectionResolver,
            new Filesystem()
        );

    }

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('migrate');
        $this->setDescription('Run the database migrations');
        $this->addOption('path', InputOption::VALUE_REQUIRED);
    }


    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface $input An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    public function fire()
    {
        $this->prepareDatabase();

        if (($path = $this->input->getOption('path'))) {
            $path = $_SERVER['DOCUMENT_ROOT'].'/'.$path;
        } else {
            $path = $this->getMigrationPath();
        }

        $migrator = $this->migrator;
        if (method_exists($migrator, 'setOutput')) {
            $migrator->setOutput($this->output);
        }

        $migrator->run($path);

        if (method_exists($migrator, 'getNotes')) {
            foreach ($migrator->getNotes() as $note) {
                $this->output->writeln($note);
            }
        }
    }

    /**
     * Prepare the migration database for running.
     *
     * @return void
     */
    protected function prepareDatabase()
    {
        if (! $this->migrator->repositoryExists()) {
            $this->call('migrate:install');
        }
    }

}
