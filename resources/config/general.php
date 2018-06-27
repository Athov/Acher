<?php

return array(
    // the web site whole url address MUST end with trailing slash
    'url' => 'http://acher.local/',
    // valid "development","production"
    'environment' => 'development',
    // The site language
    'language' => 'english',
    // The main theme file: views/template.php
    'theme_file' => 'template',
    // Application folders
    'views_folder' => ROOT . DS . 'resources' . DS . 'views' . DS,
    // 
    'autoload' => array(
        'database' => true,
        'input' => true,
        'validation' => true,
    ),
);
