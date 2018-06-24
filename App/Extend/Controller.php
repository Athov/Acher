<?php

namespace App\Extend;

use Core\Classes\Controller as MainController;
use Core\Classes\View as View;
use Core\Classes\Lang as Lang;

class Controller extends MainController
{
    public function __construct()
    {
        parent::__construct();
        Lang::setLanguage('bg');
    }
    
}