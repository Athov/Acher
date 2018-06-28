<?php
/*
 * This file is part of the Acher framework.
 *
 * (c) Atanas Harapov <atanas.harapov@abv.bg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Helpers;
/**
 * Lang class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Language
{
    private $loaded = array();
    private static $folder = null;
    private $language = null;

    public function set($language)
    {
        $this->language = $language;
    }

    public function get()
    {
        return $this->language;
    }
    
    public static function setFolder($path)
    {
        self::$folder = $path;
    }

    public static function getFolder()
    {
        return self::$folder;
    }
    
    public function load($file_name)
    {
        if(empty($file_name))
        {
            throw new \Exception('The language file name is empty.');
        }
        $file_path = self::getFolder() . $this->get() . DS . $file_name . '.php';

        if ( ! file_exists($file_path))
        {
            throw new \Exception('The language file "' . $file_path . '" does not exists or it is unreadable.');
        }

        if(array_key_exists($file_name, $this->loaded))
        {
            return $this->loaded[$file_name];
        }
        else
        {
            return $this->loaded[$file_name] = require $file_path;
        }
    }
    
    public function translate($lang, $data = null)
    {
        @list($file, $var) = explode('.', $lang);

        $this->load($file);

        if (array_key_exists($var, $this->loaded[$file]))
        {
            if(is_array($data))
            {
                array_unshift($data, $this->loaded[$file][$var]);
                return call_user_func_array('sprintf', $data);
            }
            return sprintf($this->loaded[$file][$var], $data);
        }
        
        return $data;
    }
}
