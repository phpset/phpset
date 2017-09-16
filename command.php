<?php
define('APP_START_TIME', microtime(true));
define('APP_DIR', __DIR__);

require_once __DIR__ . '/vendor/autoload.php';


// Set up Container
$env = require __DIR__ . '/config/env.php';
$services = require __DIR__ . '/config/services.php';
$container = \Injectable\Factories\LeagueFactory::fromConfig($services, [$env]);
\Injectable\ContainerSingleton::setContainer($container);

// Run Console
$cli = new \Symfony\Component\Console\Application();
$cli->addCommands(require __DIR__ . '/config/commands.php');
$cli->run();
