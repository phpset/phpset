<?php

namespace App\Http\Controllers;

class NotFoundController
{
    public function showMessage()
    {
        echo 'Not Found :(';
        die;
    }
}