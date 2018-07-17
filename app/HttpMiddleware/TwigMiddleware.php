<?php


namespace App\HttpMiddleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;

class TwigMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        /* @var \Psr\Http\Message\ResponseInterface $response */
        $response = $delegate->process($request);

        $stream = \GuzzleHttp\Psr7\stream_for('<h1>aaaa!</h1>');
        $response = $response->withBody($stream);

        return $response;
    }
}