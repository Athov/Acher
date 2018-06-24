<?php

require ROOT . DS . 'core' . DS . 'classes' . DS . 'autoloader.php';

$loader = new \Core\Classes\Autoloader();

$loader->register();

$loader->addNamespace('Core', ROOT . DS . 'core' . DS);
$loader->addNamespace('App', ROOT . DS . 'app' . DS);

\set_exception_handler(array('Core\\Classes\\ErrorHandling', 'handler'));

\Core\Classes\Config::setFolder(ROOT . DS . 'app' . DS . 'config' . DS);

\Core\Classes\Lang::setFolder(ROOT . DS . 'app' . DS . 'lang' . DS);

$config = \Core\Classes\Config::get('general');

\Core\Classes\Lang::setLanguage($config['language']);

\Core\Classes\View::setThemeFile($config['theme_file']);

\Core\Classes\View::setFolder($config['views_folder']);

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