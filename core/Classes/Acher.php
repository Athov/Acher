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
 * Acher class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Acher
{
	/**
     * Static
	 * @var string The instance of the class
	 */
    private static $instance = null;

    /**
     * Prevent the class from being instantiated.
     */
    private function __construct(){}
    
    /**
     * Make the class Singleton.
     *
     * @return class The instance of this class
     */
    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function includeRoutes()
    {
        require ROOT . DS . 'app' . DS . 'routes.php';
    }
    
    public function setupFolders()
    {
        Config::setFolder(ROOT . DS . 'resources' . DS . 'config' . DS);
        Lang::setFolder(ROOT . DS . 'resources' . DS . 'lang' . DS);
    }

    public function setConfiguration()
    {
        $config = Config::get('general');
        
        Lang::setLanguage($config['language']);
        
        View::setThemeFile($config['theme_file']);
        
        View::setFolder($config['views_folder']);
    }

    public function setupErrorHandling()
    {
        set_error_handler(array('Core\\Classes\\ErrorHandling', 'errorHandler'));
        set_exception_handler(array('Core\\Classes\\ErrorHandling', 'exceptionHandler'));
    }

    public function processHttpRequest()
    {
        $router = Router::getInstance();
        $router->response();
    }
}
