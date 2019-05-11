<?php


namespace App\HttpMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CorsMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /* @var \Psr\Http\Message\ResponseInterface $response */
        $response = $handler->handle($request);

        $headers = [
            'Origin',
            'X-Requested-With',
            'Content-Range',
            'Content-Disposition',
            'Content-Type',
            'Authorization',
            'Accept',
            'Client-Security-Token',
            'X-CSRFToken',
        ];

        $method = [
            'POST',
            'GET',
            'OPTIONS',
            'DELETE',
            'PUT'
        ];

        $response = $response
            ->withHeader("Access-Control-Allow-Origin", '*')
            ->withHeader("Access-Control-Allow-Methods", implode(',', $method))
            ->withHeader("Access-Control-Allow-Headers", implode(',', $headers))
            ->withHeader('Access-Control-Max-Age', '86400')
            ->withHeader("Access-Control-Allow-Credentials", 'true');

        return $response;
    }
}