<?php

namespace App\Controllers;

use App\Extend\Controller as Controller;
use Core\Classes\View as View;
use Core\Classes\Lang as Lang;

use App\Models\Product as Product;

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
        $this->view->forge('home/hello');
    }
    
    public function products()
    {
        $product = new Product();
        
        $data['chars'] = $product->getAll();
        $this->view->forge('home/products', $data);
    }
    public function product($id)
    {
        $product = new Product();

        $data['row'] = $product->findId($id);
        $this->view->forge('home/product', $data);
    }
    
}