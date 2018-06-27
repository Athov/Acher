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

use Core\Helpers\Validation;
use Core\Helpers\Input;
/**
 * Controller class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Controller 
{
    protected $input = null;
    protected $validation = null;
    protected $view = null;

    public function __construct()
    {
        $config = Config::get('general');
        $this->input = ($config['autoload']['input']) ? Input::getInstance() : null;
        $this->validation = ($config['autoload']['validation']) ? Validation::getInstance() : null;
        $this->view = new View();
    }
}
