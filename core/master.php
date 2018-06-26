<?php

require ROOT . DS . 'core' . DS . 'Autoloader.php';

use Core\Autoloader;
use Core\Classes\Lang;
use Core\Classes\View;
use Core\Classes\Config;
use Core\Classes\Request;

$loader = new Autoloader();

$loader->register();

$loader->addNamespace('Core', ROOT . DS . 'core' . DS);
$loader->addNamespace('App', ROOT . DS . 'app' . DS);

require ROOT . DS . 'app' . DS . 'routes.php';

Config::setFolder(ROOT . DS . 'resources' . DS . 'config' . DS);

Lang::setFolder(ROOT . DS . 'resources' . DS . 'lang' . DS);

$config = Config::get('general');

Lang::setLanguage($config['language']);

View::setThemeFile($config['theme_file']);

View::setFolder($config['views_folder']);

set_error_handler(array('Core\\Classes\\ErrorHandling', 'errorHandler'));
set_exception_handler(array('Core\\Classes\\ErrorHandling', 'exceptionHandler'));

$request = Request::getInstance();

// process the http request and load the controller
$request->requestResponse();
