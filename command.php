<?php
define('APP_START_TIME', microtime(true));
require_once __DIR__ . '/vendor/autoload.php';

$cli = new \Symfony\Component\Console\Application();
$cli->addCommands(require __DIR__ . '/config/commands.php');
$cli->run();
