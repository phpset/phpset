<?php
define('APP_START_TIME', microtime(true));
define('APP_DIR', __DIR__ . '/../');
require APP_DIR . 'vendor/autoload.php';

$configsPath = APP_DIR . 'config/';

// Set up Container
$env = file_exists($configsPath . 'env.php') ? include $configsPath . 'env.php' : [];
$services = file_exists($configsPath . 'services.php') ? include $configsPath . 'services.php' : [];
$container = new \League\Container\Container();
$container->delegate(new League\Container\ReflectionContainer); // Enable auto wiring
foreach ($services as $name => $concrete) {
    $container->add($name, $concrete, true);
}


// Building Router and HTTP middleware
$router = new League\Route\Router();
$routesConfig = file_exists($configsPath . 'routes.php') ? include $configsPath . 'routes.php' : [];
foreach ($routesConfig as $record) {
    $httpMethod = strtoupper($record[0]);
    $path = $record[1];
    $controller = $record[2];
    $method = $record[3];
    $router->map($httpMethod, $path, [$controller, $method]);
}

$middlewareConfig = file_exists($configsPath . 'middleware.php') ? include $configsPath . 'middleware.php' : [];
foreach ($middlewareConfig as $record) {
    $router->middleware($record);
}

// Make JSON response (for API)
$responseFactory = new \Http\Factory\Guzzle\ResponseFactory();
$strategy = new League\Route\Strategy\JsonStrategy($responseFactory);
$strategy->setContainer($container);
$router->setStrategy($strategy);

// Processing request
$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
ob_start(); // catch any error and other text
$response = $router->dispatch($request);
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
