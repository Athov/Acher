<?php
$routes = array();

// GET
$routes['GET']['/'] = 'App\\Controllers\\Home@index';
$routes['GET']['/features'] = 'App\\Controllers\\Features@index';
$routes['GET']['/pictures'] = 'App\\Controllers\\Pictures@index';
$routes['GET']['/pictures/(\d+)'] = 'App\\Controllers\\Pictures@show';
$routes['GET']['/pictures/create'] = 'App\\Controllers\\Pictures@create';
$routes['GET']['/pictures/edit/(\d+)'] = 'App\\Controllers\\Pictures@edit';

$routes['GET']['/language/(\w+)'] = 'App\\Controllers\\Home@language';

$routes['GET']['/hello/(.*)'] = function($name)
{
    echo 'Hello, ' . $name;
};

// POST
$routes['POST']['/pictures'] = 'App\\Controllers\\Pictures@store';

// PUT
$routes['PUT']['/pictures/(\d+)'] = 'App\\Controllers\\Pictures@update';

// POST
$routes['DELETE']['/pictures/(\d+)'] = 'App\\Controllers\\Pictures@delete';

return $routes;