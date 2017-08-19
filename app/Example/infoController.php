<?php


namespace App\Example;

use App\Base\HttpController;

class infoController extends HttpController
{
    public function getInfo()
    {

        return ['var' => 'value'];
    }
}