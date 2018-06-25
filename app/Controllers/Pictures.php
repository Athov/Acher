<?php

namespace App\Controllers;

use App\Extend\Controller as Controller;
use App\Models\Picture;

class Pictures extends Controller
{
    private $picture = null;

    public function __construct()
    {
        parent::__construct();
        $this->picture = new Picture();
    }

    public function index()
    {
        $data['pictures'] = $this->picture->getAll();
        $this->view->forge('pictures/index', $data);
    }

    public function show(int $id) // gives error on PHP 5 works on PHP 7
    {
        $data['picture'] = $this->picture->findId($id);
        $this->view->forge('pictures/show', $data);
    }
}
