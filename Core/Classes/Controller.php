<?php
namespace Core\Classes;

use Core\Classes\DB\PDODriver as PDODriver;
use Core\Classes\View as View;

class Controller 
{
    protected $db = NULL;
    protected $input = null;
    protected $validation = null;
    protected $view = null;

    public function __construct()
    {
        $config = Config::get('general');
        $this->db = ($config['autoload']['database']) ? new PDODriver() : null;
        $this->input = ($config['autoload']['input']) ? Input::getInstance() : null;
        $this->validation = ($config['autoload']['validation']) ? Validation::getInstance() : null;
        $this->view = new View();
    }
}
