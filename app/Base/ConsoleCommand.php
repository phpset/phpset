<?php
declare(strict_types = 1);


namespace App\Base;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @property InputInterface input
 * @property OutputInterface output
 */
abstract class ConsoleCommand extends \Symfony\Component\Console\Command\Command
{
    use Injectable;

    protected $input;
    protected $output;

    abstract public function handle();

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->handle();
    }
}