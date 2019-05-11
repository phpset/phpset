<?php


namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;

class ExampleController
{
    public function index(ServerRequestInterface $request): array
    {
        return ['works'];
    }
}