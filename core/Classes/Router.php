<?php
namespace Core\Classes;

class Router
{
    const PREG_X = '/({:.+?})/';

    private static $instance = null;
    private $routes = array();

    private $patterns = [
        ':any'  => '.*',
        ':id'   => '[0-9]+',
        ':slug' => '[a-z\-]+',
        ':name' => '[a-zA-Z]+',
    ];

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
    
    public function addRoute($method, $route, $location)
    {
        if( preg_match(self::PREG_X, $route))
        {
            $route = str_replace(array('{', '}'), '' , $route);
        }
        $this->routes[$method][$route] = $location;
    }

    public function matchRoutes($uri)
    {
        $method = $this->getRequestMethod();
        $routes = $this->getRoutes();
        
        if(array_key_exists($method, $routes))
        {
            $uri_explode = explode('/', trim($uri, '/'));

            foreach ($routes[$method] as $route => $location)
            {
                if($key = strstr($route, ':'))
                {
                    $route = str_replace($key, $this->patterns[$key], $route);
                }

                if(!preg_match("#^$route$#", $uri))
                {
                    continue ;
                }

                $route_explode = explode('/', $route);

                $params = array_diff(array_replace($route_explode, $uri_explode), $route_explode);

                return array(
                    'location' => $location,
                    'params' => $params
                );
            }
        }
        return false;
    }
}
