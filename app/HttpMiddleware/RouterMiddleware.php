<?php

namespace App\HttpMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class RouterMiddleware implements MiddlewareInterface
{
    const HANDLER_ATTRIBUTE = 'request-handler';
    const TEMPLATE_ATTRIBUTE = 'request-template';

    private $routes;
    private $notFoundCallable;

    public function __construct(array $routes, $notFoundCallable, $processResultCallable = null)
    {
        $this->routes = $routes;
        $this->notFoundCallable = $notFoundCallable;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Process routes
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            foreach ($this->routes as $route) {
                $r->addRoute($route[0], $route[1], $route);
            }
        });

        // Dispatch request
        $method = strtoupper($request->getMethod());
        $routeInfo = $dispatcher->dispatch($method, $request->getUri()->getPath());

        // Route is Not Found
        if ($routeInfo[0] !== \FastRoute\Dispatcher::FOUND) {
            $request = $request->withAttribute(self::HANDLER_ATTRIBUTE, $this->notFoundCallable);
            return $handler->handle($request);
        }

        // Found below
        $routeData = $routeInfo[1];
        $handlerClass = $routeData[2] . '::' . $routeData[3];
        $template = $routeData[4];


        // Add GET params to Request attributes
        if (isset($routeInfo[2])) {
            foreach ($routeInfo[2] as $name => $value) {
                $request = $request->withAttribute($name, $value);
            }
        }

        $request = $request->withAttribute(self::HANDLER_ATTRIBUTE, $handlerClass);
        $request = $request->withAttribute(self::TEMPLATE_ATTRIBUTE, $template);
        return $handler->handle($request);
    }
}