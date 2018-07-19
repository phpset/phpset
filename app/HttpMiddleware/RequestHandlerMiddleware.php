<?php

namespace App\HttpMiddleware;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;


class RequestHandlerMiddleware implements MiddlewareInterface
{
    const HANDLER_ATTRIBUTE = 'request-handler';

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $handlerAttr = $request->getAttribute(self::HANDLER_ATTRIBUTE);
        list($class, $method) = explode('::', $handlerAttr);
        $class = new $class;
        $result = call_user_func_array([$class, $method], [$request]);
        $body = json_encode($result);
        $status = 200;
        $headers = [];
        return new Response($status, $headers, $body);
    }
}