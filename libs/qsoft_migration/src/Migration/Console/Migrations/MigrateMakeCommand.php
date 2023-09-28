<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 05.08.15
 * Time: 20:01
 */

namespace QSoft\Migration\Console\Migrations;

use Bitrix\Main\Config\Option;
use Illuminate\Filesystem\Filesystem;
use QSoft\Migration\MigrationFactory;
use QSoft\Foundation\Composer;
use QSoft\Foundation\Console\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateMakeCommand extends BaseCommand
{
    /**
     * The migrator instance.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected $creator;

    /**
     * The Composer instance.
     *
     * @var \QSoft\Foundation\Composer
     */
    protected $composer;

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
        $this->composer = new Composer(new Filesystem());
    }

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        error_reporting(E_ALL);
        $this->setName('make:migration');
        $this->setDescription('Create a new migration file. Available: iblock_type, option or [table name]');
        $this->addArgument('name', InputArgument::REQUIRED);
        $this->addOption('update', null, InputOption::VALUE_REQUIRED);
        $this->addOption('create', null, InputOption::VALUE_REQUIRED);
        $this->addOption('remove', null, InputOption::VALUE_REQUIRED);
        $this->addOption('table', null, InputOption::VALUE_NONE);
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
        $name = $this->input->getArgument('name');
        $table = $this->input->getOption('update');
        $create = $this->input->getOption('create');
        $remove = $this->input->getOption('remove');
        $force_table = $this->input->getOption('table');

        $this->writeMigration($name, $table, $create, $remove, $force_table);

        $this->composer->dumpAutoloads();
    }

    /**
     * Write the migration file to disk.
     *
     * @param  string $name
     * @param  string $table
     * @param  bool $create
     * @param  bool $remove
     * @param $force_table
     * @return string
     */
    protected function writeMigration($name, $table, $create, $remove, $force_table)
    {
        $entity = ($table ?: $create) ?: $remove;

        $migrationCreator = MigrationFactory::factory($entity, $force_table);
        $migrationCreator->setFileName($name);
        $migrationCreator->setPath($this->getMigrationPath());

        $method = 'create';
        if ($table) $method = 'update';
        if ($remove) $method = 'remove';

        $data = [];

        if (!$force_table && $handler = $this->getHandler($entity)) {
            $data = $this->{$handler}($method);
        }

        $file = pathinfo($migrationCreator->{$method}($data), PATHINFO_FILENAME);

        $this->output->writeln("<info>Created Migration:</info> $file");
    }

    protected function getOptionData($method) {

        if ($method !== 'create')
            throw new \RuntimeException('Method not allowed');

        $data = [];

        $data['moduleId'] = $this->ask('What is option module Id', null, true);
        $data['optionName'] = $this->ask('What is option name', null, true);
        $data['optionValue'] = $this->ask('What is option value', null, true);

        $data['optionPrevValue'] = Option::get($data['moduleId'], $data['optionName']);

        return $data;
    }

    protected function getIblockTypeData($method)
    {
        $data = [];

        $data['iblockTypeId'] = $this->ask('What is your iblock type ID', null, true);

        if ($method !== 'remove') {
            $data['sectionsEnabled'] = $this->ask('Enable sections tree', 'Y');
            $data['rssEnabled'] = $this->ask('Enable RSS export', 'N');
        }

        return $data;
    }

    private function getHandler($entity)
    {
        $method = 'get'.ucfirst(camel_case($entity)).'Data';

        if (method_exists($this, $method))
            return $method;

        return false;
    }

}
