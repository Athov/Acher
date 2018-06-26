<?php
namespace Core\Classes;

class Router
{
    private static $instance = null;
    private $routes = array();

    private $patterns = array(
        ':any'  => '.*',
        ':id'   => '[0-9]+',
        ':num'   => '[0-9]+',
        ':slug' => '[a-z\-]+',
        ':name' => '[a-zA-Z]+',
    );

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
        $this->routes[$method][$route] = $location;
    }

    public function matchRoutes($uri)
    {
        $method = $this->getRequestMethod();
        $routes = $this->getRoutes();
        
        if(array_key_exists($method, $routes))
        {
            foreach ($routes[$method] as $route => $location)
            {
                if(preg_match('/({:.+?})/', $route))
                {
                    $route = preg_replace_callback('/{(:.+?)}/', function($key)
                    {
                        if(array_key_exists($key[1], $this->patterns))
                        {
                            return $this->patterns[$key[1]];
                        }
                    }, $route);
                }

                if(!preg_match("#^$route$#", $uri))
                {
                    continue ;
                }

                $route_explode = explode('/', $route);
                $params = array_diff(array_replace($route_explode, explode('/', $uri)), $route_explode);

                return array(
                    'location' => $location,
                    'params' => $params
                );
            }
        }
        return false;
    }
}
