<?php

namespace App\Controllers;

use Core\Classes\Controller as Controller;
use Core\Classes\View as View;
use Core\Classes\Lang as Lang;

class Test extends Controller
{
    function index()
    {
        $this->view->forge('test/index');
    }
}