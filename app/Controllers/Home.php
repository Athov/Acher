<?php

namespace App\Controllers;

use App\Extend\Controller;

class Home extends Controller
{
    public function index()
    {
        $this->view->forge('home/index');
    }
}