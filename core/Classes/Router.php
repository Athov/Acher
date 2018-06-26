<?php
namespace Core\Classes;

class Router {

    private static $instance = null;
    private $routes = array();
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
    
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }
    
    public function getRoutes()
    {
        return $this->routes;
    }

    public function getRequestMethod()
    {
        return (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) ? 
                        $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] : 
                            $_SERVER['REQUEST_METHOD'];
    }
    
    public function addRoute($method, $route, $call)
    {
        if( preg_match("/({:.+?})/", $route))
        {
           $route = preg_replace("/(\/{:.+?})/", '' , $route);
        }
        $this->routes[$method][trim($route, '/')] = $call;
    }

    public function matchRoutes($uri)
    {
        $method = $this->getRequestMethod();
        $routes = $this->getRoutes();
        if(array_key_exists($method, $routes))
        {
            $uri_explode = explode('/', trim($uri, '/'));
            $uri_element = implode('/', array_slice($uri_explode, 0, 2));

            foreach ($routes[$method] as $route => $call)
            {

                if(!preg_match("#^$route$#", $uri_element))
                {
                    continue ;
                }
                list($controller, $action) = explode('@', $call);

                return array(
                    'controller' => $controller,
                    'action' => $action,
                    'params' => array_slice($uri_explode, 2)
                );
            }
        }
    }
}
