<?php

use Core\Classes\File;
use Core\Classes\View;

/**
 * This is where all the small helper functions will be.
 * 
 * ! All of these functions are EXPERIMENTAL and will be changed.
 * 
 */

if(!function_exists('dump'))
{
    /**
     * Format data, dump data 
     *
     * @return void
     */
    function dump()
    {
        $data['dump_data'] = func_get_args();
        $view = new View();
        $view->forge('framework/dump', $data, false);
    }
}

if(!function_exists('dd'))
{
    /**
     * Format data, dump data and die 
     *
     * @return void
     */
    function dd()
    {
        call_user_func_array('dump', func_get_args());
        die();
    }
}

if(!function_exists('str_contains'))
{
    /**
     * Check if a string contains a character
     * 
     * You can search for multiple needles if one exist it will return true
     *
     * @param string $string The haystack
     * @param mixed $needles The Needles can be a string or array
     * @return boolean
     */
    function str_contains($string, $needles)
    {
        $needles = (array) $needles;
        foreach ($needles as $needle) {
            if (!empty($needle) && mb_strpos($string, $needle) !== false) {
                return true;
            }
        }
        return false;
    }
}

if(!function_exists('settings'))
{
    /**
     * Get settings.php data
     *
     * @param string $var setting name
     * @return mixed
     */
    function settings($var, $default = null)
    {
        if(empty($var)) {
            return $default;
        }
        
        $file_path =  ROOT . DS . 'settings.php';
        $data = File::load('settings', $file_path, 'settings');

        if(str_contains($var, '.')) {
            $explode = explode('.', $var);

            foreach($explode as $value) {
                if(empty($data) || !array_key_exists($value, $data)) {
                    return $default;
                }
                $data = $data[$value];
            }

            return $data;
        }

        if(empty($data) || !array_key_exists($var, $data)) {
            return $default;
        }

        return $data[$var];
    }
}