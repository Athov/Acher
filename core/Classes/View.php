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
 * View class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class View 
{
    private static $folder = null;
    private static $theme_file = null;
    private $data = array();

    private $file = array(
        'theme' => null,
        'view' => null
    );

    public function forge($view = null, $data = array())
    {
        if( ! empty(self::getThemeFile()))
        {
            $this->setFile(self::getThemeFile(), 'theme');
        }
        $this->setFile($view, 'view');
        $this->setData($data);
        return $this->render();
    }
    
    public static function setFolder($path)
    {
        self::$folder = $path;
    }
    
    public static function getFolder()
    {
        return self::$folder;
    }
    
    public static function setThemeFile($file_name)
    {
        self::$theme_file = $file_name;
    }
    
    public static function getThemeFile()
    {
        return self::$theme_file;
    }
    
    public function setData($data = array())
    {
        if(is_array($data))
        {
            $this->data = array_merge($this->data, $data);
        }
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }
    
    public function setFile($name, $type = 'view')
    {
        $name = str_replace('/', DS, str_replace('\\', DS, $name));
        $file_path = self::getFolder() . $name . '.php';
        if ( ! file_exists($file_path))
        {
            throw new \Exception(Lang::get('general.non_existent_file', $file_path));
        }
        $this->file[$type] = $file_path;
        return $this;
    }

    public function getFile($type)
    {
        return $this->file[$type];
    }
    
    public function render()
    {
        if (empty($this->getFile('theme')) OR !is_string($this->getFile('theme'))) {
            echo $this->process();
        } else {
            extract($this->getData(), EXTR_REFS);
            $content = $this->process();
            
            require_once $this->getFile('theme');
        }
    }
    
    private function process()
    {
        extract($this->getData(), EXTR_REFS);
        
        ob_start();

        try
        {
            require_once $this->getFile('view');
        }
        catch (\Exception $err)
        {
            ob_end_clean();

            throw new $err;
        }

        return ob_get_clean();
    }
}
