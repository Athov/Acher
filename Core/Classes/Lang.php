<?php
namespace Core\Classes;

class Lang
{
    private static $loaded = array();
    private static $folder = null;
    private static $language = null;

    public static function setLanguage($language)
    {
        self::$language = $language;
    }

    public static function getLanguage()
    {
        return self::$language;
    }
    
    public static function setFolder($path)
    {
        self::$folder = $path;
    }

    public static function getFolder()
    {
        return self::$folder;
    }
    
    public static function load($file_name)
    {
        if(empty($file_name))
        {
            throw new \Exception(self::get('general.empty_file_name', 'lang'));
        }
        $file_path = self::getFolder() . self::getLanguage() . DS . $file_name . '.php';

        if ( ! file_exists($file_path))
        {
            throw new \Exception(self::get('general.non_existent_unreadable_file', $file_path));
        }

        if(array_key_exists($file_name, self::$loaded))
        {
            return self::$loaded[$file_name];
        }
        else
        {
            return self::$loaded[$file_name] = require $file_path;
        }
    }
    
    public static function get($lang, $data = null)
    {
        @list($file, $var) = explode('.', $lang);

        self::load($file);

        if (array_key_exists($var, self::$loaded[$file]))
        {
            if(is_array($data))
            {
                array_unshift($data, self::$loaded[$file][$var]);
                return call_user_func_array('sprintf', $data);
            }
            return sprintf(self::$loaded[$file][$var], $data);
        }
        
        return $data;
    }
}
