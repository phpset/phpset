<?php

namespace App\Http\Controllers\Example;

use Psr\Http\Message\ServerRequestInterface;

class InfoController
{
    public function getInfo(ServerRequestInterface $request)
    {
        return ['var' => 'value'];
    }
}