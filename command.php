<?php
define('APP_START_TIME', microtime(true));
require_once __DIR__ . '/vendor/autoload.php';

// Set up Container
$services = require_once __DIR__ . '/config/services.php';
$container = \Injectable\Factories\LeagueFactory::fromConfig($services);
\Injectable\ContainerSingleton::setContainer($container);

// Run Console
$cli = new \Symfony\Component\Console\Application();
$cli->addCommands(require __DIR__ . '/config/commands.php');
$cli->run();
