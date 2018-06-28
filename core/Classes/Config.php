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
 * Config class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Config
{
    private static $loaded = array();
    private static $folder = null;
    
    public static function setFolder($path)
    {
        self::$folder = $path;
    }

    public static function getFolder()
    {
        return self::$folder;
    }
	
    public static function load($name = null)
    {
        $file_path =  self::getFolder() . $name . '.php';

        if (! file_exists($file_path))
        {
            throw new \Exception('The config file "' . $file_path . '" does not exists.');
        }
        return include $file_path;
    }

    public static function get($file_name = null)
    {
        if(empty($file_name))
        {
            throw new \Exception('The config file name is empty');
        }
        
        if(array_key_exists($file_name, self::$loaded))
        {
            return self::$loaded[$file_name];
        }
        else
        {
            $file_data = self::load($file_name);
            return self::$loaded[$file_name] = $file_data;
        }
    }
}
