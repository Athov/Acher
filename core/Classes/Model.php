<?php
namespace Core\Classes;

use Core\Helpers\Database;
use Core\Helpers\Input;

class Model
{
    protected $db = null;
    protected $input = null;
    
    public function __construct()
    {
        $config = Config::get('general');

        $this->db = ($config['autoload']['database']) ? new Database() : null;
        $this->input = ($config['autoload']['input']) ? Input::getInstance() : null;
    }
}
