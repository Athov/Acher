<?php
namespace Core\Classes;

use Core\Classes\DB\PDODriver;

class Model
{
    protected $db = null;
    protected $input = null;
    protected $validation = null;

    public function __construct()
    {
        $config = Config::get('general');

        $this->db = ($config['autoload']['database']) ? new PDODriver() : null;
        $this->input = ($config['autoload']['input']) ? Input::getInstance() : null;
    }
}
