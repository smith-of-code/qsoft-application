<?php
/**
 * Created by PhpStorm.
 * User: vyfvfv
 * Date: 07.08.15
 * Time: 14:14
 */

use QSoft\Foundation\Disposer;

if (defined('DISPOSER_APP')) {
    Disposer::add(new \QSoft\Migration\Console\Migrations\InstallCommand());
    Disposer::add(new \QSoft\Migration\Console\Migrations\StatusCommand());
    Disposer::add(new \QSoft\Migration\Console\Migrations\MigrateCommand());
    Disposer::add(new \QSoft\Migration\Console\Migrations\RollbackCommand());
    Disposer::add(new \QSoft\Migration\Console\Migrations\ResetCommand());
    Disposer::add(new \QSoft\Migration\Console\Migrations\RefreshCommand());
    Disposer::add(new \QSoft\Migration\Console\Migrations\MigrateMakeCommand());
}