<?php

namespace App\Controllers;

use App\Extend\Controller as Controller;
use App\Models\Picture;

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $picture = new Picture();
        $data['pictures'] = $picture->getTop12();
        $this->view->forge('home/index', $data);
    }
}
