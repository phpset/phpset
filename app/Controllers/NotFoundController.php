<?php


namespace App\Controllers;


use App\Base\HttpController;

class NotFoundController extends HttpController
{
    public function showMessage()
    {
        $this->response = $this->response->withStatus(404);
    }
}