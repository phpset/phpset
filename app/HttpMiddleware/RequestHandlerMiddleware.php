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
        $response = new Response(200);
        $handlerAttr = $request->getAttribute(self::HANDLER_ATTRIBUTE);
        list($class, $method) = explode('::', $handlerAttr);
        $class = new $class($request, $response);
        $result = call_user_func_array([$class, $method], []);
        if ($result !== null) {
            $body = json_encode($result);
            if ($body) {
                $stream = \GuzzleHttp\Psr7\stream_for($body);
                $response = $response->withBody($stream);
            }
        }
        return $response;
    }
}