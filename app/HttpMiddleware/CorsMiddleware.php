<?php


namespace App\HttpMiddleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;

class CorsMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        /* @var \Psr\Http\Message\ResponseInterface $response */
        $response = $delegate->process($request);

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