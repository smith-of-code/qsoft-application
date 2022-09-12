<?php
declare(strict_types=1);
namespace QSoft\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $description = 'Example command';
    protected $signature = 'test-command
                            {arg? : optional argument}
                            {--key1 : boolean option}
                            {--key2= : nullable string option}
                            {--key3=default-value : nullable string option with default value}';

    function handle()
    {
        dump($this->argument('arg'));
        dump($this->option('key1'));
        dump($this->option('key2'));
        dump($this->option('key3'));

        // Кладём сообщение в очередь:
	app('queue')->push(\QSoft\Jobs\TestJob::class, ['aaa' => 12345], 'queue-name-123');
        // Для обработки надо запустить: ./disposer queue:work --queue=queue-name-123
        // Больше разных опций: ./disposer queue:work --help

        $this->output->writeln('Done.');
    }
}
