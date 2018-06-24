<?php
$application_folder = 'app';
$core_folder = 'core';

define('ENV', 'development'); // valid "development","production"

define('APP', realpath(__DIR__ . DIRECTORY_SEPARATOR . $application_folder).DIRECTORY_SEPARATOR);
define('CORE', realpath(__DIR__ . DIRECTORY_SEPARATOR . $core_folder).DIRECTORY_SEPARATOR);

require 'core/core.php';

$request = Request::getInstance();
$request->setConfig(array(
    
        // The folder where the controllers are
        'controllers_folder' => APP . 'controllers' . DIRECTORY_SEPARATOR,
        
        // The sub folder of where the framework is located
        // example:
        // http://localhost/mvc/framework/
        // 'sub_url' => '/mvc/framework/'; MUST have trailing slashs
        // if is in you main folder leave
        // 'sub_url' => '/';
        'sub_url' => '/netb/OOP/',
    
        // The default controller that will load on start
        'default_controller' => 'home',
    
        // The default method that will load on start
        'default_method' => 'index'

    ))->loader(); // process the http request and load the controller