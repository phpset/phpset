<?php
define('APP_START_TIME', microtime(true));
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

echo 'App speed about ' . round(1 / (microtime(true) - APP_START_TIME)) . ' RPS <br>';

// Build Request
$input = json_decode(file_get_contents('php://input'), true) ?: [];
$parsedBody = array_merge($_POST, $input);
$request = \Zend\Diactoros\ServerRequestFactory::fromGlobals(null, null, $parsedBody);

// Dispatch Middlewares
$dispatcher = new \Middleland\Dispatcher(require_once 'app/middlewares.php');
$response = $dispatcher->dispatch($request);

// Sending response
$statusCode = $response->getStatusCode();
$reasonPhrase = $response->getReasonPhrase();
$protocolVersion = $response->getProtocolVersion();
header("HTTP/{$protocolVersion} $statusCode $reasonPhrase");
foreach ($response->getHeaders() as $name => $values) {
    if (strtolower($name) === 'set-cookie') {
        foreach ($values as $cookie) {
            header(sprintf('Set-Cookie: %s', $cookie), false);
        }
        break;
    }
    header(sprintf('%s: %s', $name, $response->getHeaderLine($name)));
}
$body = $response->getBody();
if ($body) {
    echo $body->__toString();
}
