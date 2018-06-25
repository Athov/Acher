<?php

return array(
    // the web site whole url address MUST end with trailing slash
    'url' => 'http://acher.local/',
    // The site language
    'language' => 'english',
    // The main theme file: views/layout.php
    'theme_file' => 'template',
    // Application folders
    'views_folder' => ROOT . DS . 'resources' . DS . 'views' . DS,
    //
    'autoload' => array(
        'database' => true,
        'input' => true,
        'validation' => true,
    ),
    //
    'default' => array(
        'controller' => 'Home',
        'action' => 'index'
    ),
);