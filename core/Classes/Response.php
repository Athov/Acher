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
 * Response class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Response
{
    public function __construct($code = 200)
    {
        $this->setCode(200);
    }

    public function setCode($code)
    {
        http_response_code($code);
    }
    
    public function json($value, $options = 0, $depth = 512)
    {
        header('Content-Type: application/json');
        echo json_encode($value, $options, $depth);
    }
    
}