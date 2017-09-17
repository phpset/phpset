<?php
declare(strict_types = 1);

namespace App\Base;

use Psr\Http\Message\RequestInterface;

/**
 * @property RequestInterface request
 */
abstract class HttpController
{
    use Injectable;

    protected $request;

    protected function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }
}