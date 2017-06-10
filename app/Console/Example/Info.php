<?php

namespace App\Commands\Example;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Info extends Command
{
    public function execute(InputInterface $input, OutputInterface $output)
    {
//        $timeStart = microtime(true);
//        file_get_contents('http://phpset.dev');

//        var_dump(get_included_files());
        echo 'App speed about ' . round(1 / (microtime(true) - APP_START_TIME)) . ' RPS';
    }
}