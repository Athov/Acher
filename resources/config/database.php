<?php

return array(
    'dsn' => 'mysql:host=' . settings('database.host', 'localhost') . ';dbname=' . settings('database.dbname', 'acher') . ';charset=utf8',
    'username' => settings('database.username', 'root'),
    'password' => settings('database.password', ''),
    'options' => array(
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_WARNING ,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
);