<?php
namespace Core\Helpers;

use Core\Classes\Config;

class Database extends \PDO 
{
    public function __construct()
    {
        $db_config = Config::get('database');
		$username = $db_config['username'];
		$password = $db_config['password'];
		$dsn = $db_config['dsn'];
        $options = $db_config['options'];
        
        parent::__construct($dsn, $username, $password, $options);
    }
}
