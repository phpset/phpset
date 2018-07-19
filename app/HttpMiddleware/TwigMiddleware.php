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

        $data = $response->getBody()->__toString();
        $data = json_decode($data, true);


        $loader = new \Twig_Loader_Filesystem(APP_DIR . 'templates');
        $twig = new \Twig_Environment($loader);
        $html = $twig->render('hello.html', $data);

        
        $stream = \GuzzleHttp\Psr7\stream_for($html);
        $response = $response->withBody($stream);
        return $response;
    }
}