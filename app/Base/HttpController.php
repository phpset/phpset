<?php


namespace App\Base;

use Psr\Http\Message\RequestInterface;

/**
 * @property RequestInterface request
 */
abstract class HttpController
{
    protected $request;

    protected function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }
}