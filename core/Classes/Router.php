<?php
/*
 * This file is part of the Acher framework.
 *
 * (c) Atanas Harapov <atanas.harapov@abv.bg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Classes;
/**
 * Router class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
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

    /**
     * Prevent the class from being instantiated.
     */
    private function __construct(){}
    
    /**
     * Make the class Singleton.
     *
     * @return class The instance of this class
     */
    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    /**
     * Get the REQUEST_URI string.
     *
     * @return string The REQUEST_URI on success
     * @throws Exception on failure
     */
    private function getUri()
    {
        $string = $_SERVER['REQUEST_URI'];
        
        // Check if the URI has a GET request and remove it 
        // from string
        if (strpos($string, '?') > 0)
        {
            $string = str_replace(strstr($string, '?'), '', $string);
        }
        
        // The URI should include only letters, numbers, forward slash(/) or a dash(-)
        if(preg_match('/[^a-zA-Z0-9_\/-]/', $string))
        {
            throw new \Exception(Lang::get('general.page_not_found'),404);
        }

        return $string;
    }

    /**
     * Get all routes.
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Gives the request method.
     *
     * @return string The method
     */
    public function getRequestMethod() // TODO PUT, DELETE
    {
        return (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) ? 
                        $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] : 
                            $_SERVER['REQUEST_METHOD'];
    }
    
    /**
     * Adds a new route.
     *
     * @param string $method The request method(POST,GET)
     * @param string $route The uri of the route
     * @param mixed $location A function() or a string
     * @return void
     */
    public function addRoute($method, $route, $location)
    {
        $this->routes[$method][$route] = $location;
    }

    /**
     * Matching the URI to a Route
     *
     * @param string $uri The REQUEST_URI String.
     * @return mixed Array on success, or boolean false on failure.
     */
    private function matchRoutes($uri)
    {
        $method = $this->getRequestMethod();
        $routes = $this->getRoutes();
        
        // Check if a method exists in the routes array
        if(array_key_exists($method, $routes))
        {
            // Loop all routes with the requested method
            foreach ($routes[$method] as $route => $location)
            {
                // Check if a route has a parameter({:p})
                if(preg_match('/({:.+?})/', $route))
                {
                    // Replace every {:p} with a pattern
                    $route = preg_replace_callback('/{(:.+?)}/', function($key)
                    {
                        if(array_key_exists($key[1], $this->patterns))
                        {
                            return $this->patterns[$key[1]];
                        }
                    }, $route);
                }

                // Match the route and URI
                if(!preg_match("#^$route$#", $uri))
                {
                    continue ;
                }

                // Get the URI parameters
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

    /**
     * Get a response from the route
     *
     * @return mixed A function or $this
     * @throws Exception 
     */
    public function response()
    {
        $route = $this->matchRoutes($this->getUri());
        
        // Check if a route is found
        if( ! $route)
        {
            throw new \Exception(Lang::get('general.page_not_found'),404);
        }

        $location = $route['location'];
        $params = $route['params'];
        
        // Check if $location is string and includes @
        if(is_string($location) && strpos($location, '@'))
        {
            // Request a class
            $this->requestClass($location, $params);
        }
        // If no parameters run a function
        elseif(empty($params))
        {
            return $location(); 
        }
        // Call the function with parameters
        else
        {
            call_user_func_array($location, $params);
        }

        return $this;
    }

    /**
     * Call a requested class
     *
     * @param string $location The requested class name and 
     * action in a string format(Class@action)
     * @param array $params Array with the arguments
     * @return void
     * @throws Exception
     * @throws Exception 
     */
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
    }

}
