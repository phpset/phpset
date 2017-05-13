<?php
define('APP_START_TIME', microtime(true));
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

// Create Request
$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

// Dispatch Middleware
$dispatcher = new \Middleland\Dispatcher(require_once 'app/middleware.php');
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
    if (strtolower($name) === 'set-cookie') {
        foreach ($values as $cookie) {
            header(sprintf('Set-Cookie: %s', $cookie), false);
        }
        break;
    }
    header(sprintf('%s: %s', $name, $response->getHeaderLine($name)));
}

// Prepare body
$body = $response->getBody();
if ($body) {
    $body = $body->__toString();
}

header('Execution-Time: ' . (microtime(true) - APP_START_TIME) * 1000);

echo $body;
