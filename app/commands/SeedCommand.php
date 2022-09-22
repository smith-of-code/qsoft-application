<?php
declare(strict_types=1);

namespace QSoft\Commands;

use Illuminate\Console\Command;

class SeedCommand extends Command
{
    protected $description = 'Run seeder';
    protected $signature = 'seed {seeder : string argument}';

    function handle()
    {
        $seeder = 'QSoft\\Seeder\\' . $this->argument('seeder');

        try {
            $seederClass = new $seeder();

            $seederClass::seed();
        } catch (\Throwable $e) {
            $this->output->error('Error happened: ' . $e->getMessage());
            return;
        }

        $this->output->success("Seeder $seeder done.");
    }
}
