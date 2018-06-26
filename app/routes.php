<?php
use Core\Classes\Router;

$router = Router::getInstance();

$router->addRoute('GET', '/', 'App\\Controllers\\Home@index');
$router->addRoute('GET', '/pictures', 'App\\Controllers\\Pictures@index');
$router->addRoute('GET', '/pictures/{:id}', 'App\\Controllers\\Pictures@show');
$router->addRoute('GET', '/features', 'App\\Controllers\\Features@index');
$router->addRoute('GET', '/users', 'App\\Controllers\\Users@index');
$router->addRoute('GET', '/users/create', 'App\\Controllers\\Users@create');
$router->addRoute('GET', '/users/edit/{:id}', 'App\\Controllers\\Users@edit');
$router->addRoute('GET', '/hello/{:name}', function($name)
{
    echo 'Hello, ' . $name;
});

$router->addRoute('POST', '/users/create', 'App\\Controllers\\Users@create');
$router->addRoute('POST', '/users/edit/{:id}', 'App\\Controllers\\Users@edit');
