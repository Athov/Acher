<?php

namespace App\Extend;

use Core\Classes\Controller as MainController;
use Core\Helpers\Language;

class Controller extends MainController
{
    protected $language = null;
    public function __construct()
    {
        parent::__construct();
        $this->language = new Language();
        $this->language->set('english');
        $this->view->setData(array(
            'title' => $this->language->load('titles')
        ));
    }
    
}
