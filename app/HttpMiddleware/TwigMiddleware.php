<?php


namespace App\HttpMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class TwigMiddleware implements MiddlewareInterface
{
    const TEMPLATE_ATTRIBUTE = 'request-template';

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /* @var \Psr\Http\Message\ResponseInterface $response */
        $response = $handler->handle($request);

        $data = $response->getBody()->__toString();
        $data = json_decode($data, true);
        if (!$data) {
            $data = [];
        }

        $template = $request->getAttribute(self::TEMPLATE_ATTRIBUTE);

        $loader = new \Twig_Loader_Filesystem(APP_DIR . 'templates');
        $twig = new \Twig_Environment($loader);
        $html = $twig->render($template, $data);


        $stream = \GuzzleHttp\Psr7\stream_for($html);
        $response = $response->withBody($stream);
        return $response;
    }
}