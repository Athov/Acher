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
    
    private function getUri()
    {
        $string = $_SERVER['REQUEST_URI'];
        
        if (strpos($string, '?') > 0)
        {
            $string = str_replace(strstr($string, '?'), '', $string);
        }
        
        if(preg_match('/[^a-zA-Z0-9_\/]/', $string))
        {
            throw new \Exception(Lang::get('general.page_not_found'),404);
        }

        return $string;
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

    public function response()
    {
        $route = $this->matchRoutes($this->getUri());
        
        if( ! $route)
        {
            throw new \Exception(Lang::get('general.page_not_found'),404);
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
