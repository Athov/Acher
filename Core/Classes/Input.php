<?php

namespace Core\Classes;

class Input 
{
    private static $instance = null;
    private static $input = array();

    private function __construct()
    {
        $this->clean('POST', $_POST);
        $this->clean('GET', $_GET);
        $this->clean('COOKIE', $_COOKIE);
    }
    
    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new static();
        }
        
        return self::$instance;
    }
    
    public static function data($method = 'POST', $key = null)
    {
        if($key === null) {
            return (isset(self::$input[$method])) ? self::$input[$method] : null;
        }
        
        return (isset(self::$input[$method][$key])) ? self::$input[$method][$key] : null;
    }

    public function post($key)
    {
        return self::data('POST', $key);
    }

    public function get($key)
    {
        return self::data('GET', $key);
    }

    public function cookie($key)
    {
        return self::data('COOKIE', $key);
    }

    public function method()
    {
        return (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) ? 
                        $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] : 
                            $_SERVER['REQUEST_METHOD'];
    }
    
    private function clean($method_key = null, $data = array())
    {
        if(is_array($data)) {
            foreach ($data as $key => $value) {
                self::$input[$method_key][$key] = Security::cleanInput($value);
            }
        }
    }
}
