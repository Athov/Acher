<?php

namespace App\Controllers;

use Core\Classes\Controller as Controller;
use Core\Classes\Lang;

class Features extends Controller
{
    function index()
    {
        $this->view->forge('features/index');
    }
}
