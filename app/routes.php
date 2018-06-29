<?php
use Core\Classes\Router;

$router = Router::getInstance();

// GET
$router->addRoute('GET', '/', 'App\\Controllers\\Home@index');
$router->addRoute('GET', '/pictures', 'App\\Controllers\\Pictures@index');
$router->addRoute('GET', '/pictures/{:id}', 'App\\Controllers\\Pictures@show');
$router->addRoute('GET', '/pictures/create', 'App\\Controllers\\Pictures@create');
$router->addRoute('GET', '/pictures/edit/{:id}', 'App\\Controllers\\Pictures@edit');
$router->addRoute('GET', '/features', 'App\\Controllers\\Features@index');

$router->addRoute('GET', '/hello/{:any}', function($name)
{
    echo 'Hello, ' . $name;
});

// POST
$router->addRoute('POST', '/pictures', 'App\\Controllers\\Pictures@store');

// PUT
$router->addRoute('PUT', '/pictures/{:id}', 'App\\Controllers\\Pictures@update');

// DELETE
$router->addRoute('DELETE', '/pictures/{:id}', 'App\\Controllers\\Pictures@delete');