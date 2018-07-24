<?php
declare(strict_types=1);

namespace App\Base;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class HttpController
{
    use Injectable;

    protected $request;
    protected $response;

    public function __construct(ServerRequestInterface $request, ResponseInterface &$response)
    {
        $this->request = $request;
        $this->response = &$response;
    }
}