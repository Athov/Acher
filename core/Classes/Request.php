<?php
namespace Core\Classes;

class Request {

    private static $instance = null;
    private $router = null;

    private function __construct()
    { 
        $this->router = Router::getInstance();
    }
    
    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function requestResponse()
    {
        $this->router->response();
    }
}
