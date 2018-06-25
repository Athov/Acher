<?php

namespace App\Controllers;

use App\Extend\Controller as Controller;
use Core\Classes\Lang;

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->setData(array(
            'title' => Lang::load('titles')
        ));
    }
    public function index()
    {
        $this->view->forge('home/index');
    }
}
