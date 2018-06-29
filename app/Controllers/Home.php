<?php

namespace App\Controllers;

use App\Extend\Controller;

class Home extends Controller
{
    public function index()
    {
        $this->view->forge('home/index');
    }

    public function language($language)
    {
        $languages = array('english', 'bulgarian');
        if(in_array($language, $languages))
        {
            $_SESSION['language'] = $language;
            header('Location: /');
        }
        else
        {
            $data['error'][] = 'The selected language is not defined.';
        }
        $this->view->setData($data);
        $this->index();
    }
}