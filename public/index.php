<?php

define('ENV', 'development');  // valid "development","production"
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

require ROOT . DS . 'Core' . DS . 'core.php';
