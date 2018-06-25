<?php
namespace Core\Classes;

class Request {

    private static $instance = null;
    private $namespace = null;
    private $uri = array();
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
    
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }
    
    public function getNamespace()
    {
        return $this->namespace;
    }

    public function setController($controller)
    {
        $this->controller = $this->getNamespace() . $controller;
    }
    
    public function getController()
    {
        return $this->controller;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }
    
    public function getAction()
    {
        return $this->action;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }
    
    public function getParams()
    {
        return $this->params;
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
        
        $this->uri = $string ? explode('/', trim($string,'/')) : array();
        return $this;
    }

    private function parseUri()
    {
        $uri_element = $this->uri;

        if( ! empty($uri_element[0]))
        {
            $this->setController(ucfirst($uri_element[0]));
        }

        if(isset($uri_element[1]))
        {
            $this->setAction($uri_element[1]);
        }

        if(isset($uri_element[2]))
        {
            $this->setParams(array_slice($uri_element, 2));
        }

        return $this;
    }

    private function routeRequest()
    {
        // Check to see if the controller class exists
        if( ! class_exists($this->controller))
        { 
            throw new \Exception(Lang::get('general.class_not_found', $this->controller), 404); 
        }
        
        // Check to see if the action exist
        if( ! method_exists($this->controller, $this->action))
        {
            throw new \Exception(Lang::get('general.undefined_method', array($this->controller, $this->action)), 1);
        }

        // Call controller->action(params)
        call_user_func_array(array(new $this->controller, $this->action), $this->params);

        return $this;
    }

}
