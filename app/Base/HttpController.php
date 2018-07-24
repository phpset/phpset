<?php
declare(strict_types=1);

namespace App\Base;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @property RequestInterface request
 * @property ResponseInterface response
 */
abstract class HttpController
{
    use Injectable;

    protected $request;
    protected $response;

    public function __construct(RequestInterface $request, ResponseInterface &$response)
    {
        $this->request = $request;
        $this->response = &$response;
    }
}