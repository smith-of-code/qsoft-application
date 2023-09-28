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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class StatusCommand extends BaseCommand
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
        $this->setName('migrate:status');
        $this->setDescription('Show the status of each migration');
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
        if (! $this->migrator->repositoryExists()) {
            return $this->output->writeln('<error>No migrations found.</error>');
        }
        $ran = $this->migrator->getRepository()->getRan();
        $migrations = [];
        foreach ($this->getAllMigrationFiles() as $migration) {
            $migration = basename($migration, '.php');
            $migrations[] = in_array($migration, $ran) ? ['<info>Y</info>', $migration] : ['<fg=red>N</fg=red>', $migration];
        }
        if (count($migrations) > 0) {

            $table = new Table($this->output);
            $table
                ->setHeaders(['Ran?', 'Migration'])
                ->setRows($migrations);

            $table->render($this->output);

        } else {
            $this->output->writeln('<error>No migrations found</error>');
        }
    }

    /**
     * Get all of the migration files.
     *
     * @return array
     */
    protected function getAllMigrationFiles()
    {
        return $this->migrator->getMigrationFiles($this->getMigrationPath());
    }

}
