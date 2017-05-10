#!/usr/bin/env php
<?php
define('APP_START_TIME', microtime(true));
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

$cli = new \Symfony\Component\Console\Application();
$cli->addCommands(require_once 'app/commands.php');
$cli->run();
