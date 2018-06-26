<?php
namespace Core\Classes;

class Request {

    private static $instance = null;
    private $uri = array();
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

    public function loader()
    {
        $this->explodeUri()->parseUri();
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

        $this->uri = $string;
        return $this;
    }

    private function parseUri()
    {
       $route = $this->router->matchRoutes($this->uri);

        if( ! $route)
        {
            throw new \Exception('The requested page is not found.',404);
        }
        
        $location = $route['location'];
        $params = $route['params'];

        if(is_string($location) && strpos($location, '@'))
        {
            $this->requestClass($location, $params);
        }
        elseif(empty($params))
        {
            return $location(); 
        }
        else
        {
            call_user_func_array($location, $params);
        }

        return $this;
    }

    private function requestClass($location, $params)
    {
        list($controller, $action) = explode('@', $location);

        // Check to see if the controller class exists
        if( ! class_exists($controller))
        { 
            throw new \Exception(Lang::get('general.class_not_found', $controller), 404); 
        }
        
        // Check to see if the action exist
        if( ! method_exists($controller, $action))
        {
            throw new \Exception(Lang::get('general.undefined_method', array($controller, $action)), 1);
        }

        // Call controller->action(params)
        call_user_func_array(array(new $controller, $action), $params);

        return $this;
    }

}
