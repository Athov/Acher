<?php
namespace Core\Classes;

use Core\Helpers\Validation;
use Core\Helpers\Input;

class Controller 
{
    protected $input = null;
    protected $validation = null;
    protected $view = null;

    public function __construct()
    {
        $config = Config::get('general');
        $this->input = ($config['autoload']['input']) ? Input::getInstance() : null;
        $this->validation = ($config['autoload']['validation']) ? Validation::getInstance() : null;
        $this->view = new View();
    }
}
