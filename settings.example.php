<?php

/**
 * This is the basic configuration settings.
 * If you need more configuration you can check in resources/config
 */ 

return [
    
    // System enviroment - "development" or "production"
    "environment" => "development",

    // DB Configuration - it uses MySQL by default you can change that in the resources/config/database.php
    "database" => [
        "host" => "localhost",
        "dbname" => "acher",
        "username" => "root",
        "password" => ""
    ]
];