<?php
define('APP_START_TIME', microtime(true));
define('APP_DIR', __DIR__ . '/../');
require APP_DIR . 'vendor/autoload.php';

$configsPath = APP_DIR . 'config/';

// Set up Container
$env = file_exists($configsPath . 'env.php') ? include $configsPath . 'env.php' : [];
$services = file_exists($configsPath . 'services.php') ? include $configsPath . 'services.php' : [];
$container = \Injectable\Factories\LeagueFactory::fromConfig($services, [$env]);
\Injectable\ContainerSingleton::setContainer($container);

// Dispatch Request
$routes = file_exists($configsPath . 'routes.php') ? include $configsPath . 'routes.php' : [];
$middleware = file_exists($configsPath . 'middleware.php') ? include $configsPath . 'middleware.php' : [];
$middleware = array_merge($middleware, [
    // Router
    new \App\HttpMiddleware\RouterMiddleware($routes, '\App\Controllers\NotFoundController::showMessage'),

    // Html Template
    new \App\HttpMiddleware\TwigMiddleware(),

    // calling Controller
    new \App\HttpMiddleware\RequestHandlerMiddleware(),
]);

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
