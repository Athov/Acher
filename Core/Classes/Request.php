<?php
namespace Core\Classes;

class Request {

    private static $instance = null;
    private $namespace = null;
    private $uri_parts = array();
    private $controller = null;
    private $current = null;
    private $action = null;
    private $params = array();

    private function __construct(){}
    
    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    public function setConfig($data = array())
    {
        $this->namespace = $data['namespace'];
        $this->controller = $data['default_controller'];
        $this->action = $data['default_action'];
        return $this;
    }
    
    public function loader()
    {
        $this->explodeUri()->parseUri()->routeRequest();
    }
    
    private function explodeUri()
    {
        $string = $_SERVER['REQUEST_URI'];
        
        if (strpos($string, '?') > 0)
        {
            $string = str_replace(strstr($string, '?'), '', $string);
        }
        
        if(preg_match('/[^a-zA-Z0-9_\/]/', $string)) {
            throw new \Exception('The requested page is not found.',404);
        }
        
        $this->uri_parts = $string ? explode('/', trim($string,'/')) : array();
        return $this;
    }

    private function parseUri()
    {
        $page = $this->uri_parts;

        $controller = (empty($page[0])) ? $this->controller : ucfirst($page[0]);

        $this->controller = $this->namespace . $controller; 
        
        $this->action = (isset($page[1])) ? $page[1] : $this->action;

        $this->params = (isset($page[2])) ? array_slice($page, 2) : $this->params;

        return $this;
    }

    private function routeRequest()
    {
        // Check to see if the controller class exists
        if( ! class_exists($this->controller))
        { 
            throw new \Exception(Lang::get('general.class_not_found', $this->controller), 404); 
        }

        // Instance of the controller
        $controller = $this->controller;
        $this->current = new $controller();
        
        // Check to see if the action exist
        if( ! method_exists($this->current, $this->action))
        {
            throw new \Exception(Lang::get('general.undefined_method', array($this->controller, $this->action)), 1);
        }

        // Call the controller action with params
        call_user_func_array(array($this->current, $this->action), $this->params);

        return $this;
    }

}
