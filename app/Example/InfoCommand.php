<?php


namespace App\Example;

use App\Base\ConsoleCommand;

class InfoCommand extends ConsoleCommand
{
    public function handle()
    {
        $this->output->writeln('APP started in ' . round((microtime(true) - APP_START_TIME) * 1000) . 'ms');
    }
}