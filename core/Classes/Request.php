<?php
/*
 * This file is part of the Acher framework.
 *
 * (c) Atanas Harapov <atanas.harapov@abv.bg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Classes;
/**
 * Request class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Request {

    private static $instance = null;
    private $router = null;

    private function __construct()
    { 
        $this->router = Router::getInstance();
    }
    
    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function requestResponse()
    {
        $this->router->response();
    }
}
