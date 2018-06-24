<?php

return array(
    'dsn' => 'mysql:host=localhost;dbname=gallery',
    'username' => 'root',
    'password' => 'warscall',
    'options' => array(
            \PDO::ATTR_PERSISTENT => true, 
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        )
);