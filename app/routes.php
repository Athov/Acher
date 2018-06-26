<?php
use Core\Classes\Router;

$router = Router::getInstance();

$router->addRoute('GET', '/', 'App\\Controllers\\Home@index');
$router->addRoute('GET', '/pictures', 'App\\Controllers\\Pictures@index');
$router->addRoute('GET', '/features', 'App\\Controllers\\Features@index');
$router->addRoute('GET', '/users', 'App\\Controllers\\Users@index');
$router->addRoute('GET', '/users/edit/{:id}', 'App\\Controllers\\Users@edit');
$router->addRoute('POST', '/users/edit/{:id}', 'App\\Controllers\\Users@edit');