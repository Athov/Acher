<?php

require ROOT . DS . 'Core' . DS . 'Classes' . DS . 'autoloader.php';

$loader = new \Core\Classes\Autoloader();

$loader->register();

$loader->addNamespace('Core', ROOT . DS . 'Core' . DS);
$loader->addNamespace('App', ROOT . DS . 'App' . DS);

\Core\Classes\Config::setFolder(ROOT . DS . 'App' . DS . 'Config' . DS);

\Core\Classes\Lang::setFolder(ROOT . DS . 'App' . DS . 'Lang' . DS);

$config = \Core\Classes\Config::get('general');

\Core\Classes\Lang::setLanguage($config['language']);

\Core\Classes\View::setThemeFile($config['theme_file']);

\Core\Classes\View::setFolder($config['views_folder']);

set_error_handler(array('Core\\Classes\\ErrorHandling', 'errorHandler'));
set_exception_handler(array('Core\\Classes\\ErrorHandling', 'exceptionHandler'));

$request = \Core\Classes\Request::getInstance();

$request->setConfig(array(
    
        // Namespace for the controllers
        'namespace' => 'App\\Controllers\\',

        // The default controller that will load on start
        'default_controller' => $config['default']['controller'],
    
        // The default action that will load on start
        'default_action' => $config['default']['action']

    ));

// process the http request and load the controller
$request->loader();
