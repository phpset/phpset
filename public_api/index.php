<?php
define('APP_START_TIME', microtime(true));
require __DIR__ . '/../vendor/autoload.php';

// Set up Container
$env = require __DIR__ . '/../config/env.php';
$services = require __DIR__ . '/../config/services.php';
$container = \Injectable\Factories\LeagueFactory::fromConfig($services, [$env]);
\Injectable\ContainerSingleton::setContainer($container);

// Dispatch Request
$middleware = require __DIR__ . '/../config/middleware.php';
$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$dispatcher = new \Middleland\Dispatcher($middleware);
ob_start(); // catch any error and other text
$response = $dispatcher->dispatch($request);
$log = ob_get_clean();

// Sending response
$statusCode = $response->getStatusCode();
$reasonPhrase = $response->getReasonPhrase();
$protocolVersion = $response->getProtocolVersion();
header("HTTP/{$protocolVersion} $statusCode $reasonPhrase");

// Sending headers
foreach ($response->getHeaders() as $name => $values) {
    header(sprintf('%s: %s', $name, $response->getHeaderLine($name)));
}
// Prepare body
$body = $response->getBody()->__toString();
header('Execution-Time: ' . (microtime(true) - APP_START_TIME) * 1000);
echo $body;
