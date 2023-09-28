<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 05.08.15
 * Time: 20:01
 */

namespace QSoft\Migration\Console\Migrations;

use QSoft\Foundation\Console\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RefreshCommand extends BaseCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('migrate:refresh');
        $this->setDescription('Reset and re-run all migrations');
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
        $this->call('migrate:reset');
        $this->call('migrate');
    }
}