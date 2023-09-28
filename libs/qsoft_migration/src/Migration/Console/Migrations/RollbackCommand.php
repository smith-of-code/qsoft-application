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

class RollbackCommand extends BaseCommand
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
        $this->setName('migrate:rollback');
        $this->setDescription('Rollback the last database migration');
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
        $migrator = $this->migrator;

        if (method_exists($migrator, 'getNotes')) {
            $migrator->rollback();

            foreach ($migrator->getNotes() as $note) {
                $this->output->writeln($note);
            }
        } else {
            $migrator->setOutput($this->output);
            $migrator->rollback($this->getMigrationPath());
        }
    }

}
