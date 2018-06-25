<?php

namespace Core\Classes;

class ErrorHandling 
{
    public static function exceptionHandler($err)
    {
        if(ENV != 'development')
        {
            $errMsg = 'An unexpected error has occurred!';
            $errCode = 1;
            if($err->getCode() === 404)
            {
                $errMsg = 'The requested page was not found!';
                $errCode = 404;
            }
        } else {
            $errMsg = $err->getMessage();
            $errCode = $err->getCode();
        }
        self::showMessages($errMsg, $errCode);
    }

    public static function errorHandler($err_number, $err_string, $err_file, $err_line)
    {
        if(ENV != 'development')
        {
            $err_message = 'An unexpected error has occurred!';
            $err_number = 1;
            if($err->getCode() === 404)
            {
                $err_message = 'The requested page was not found!';
                $err_number = 404;
            }
        } else {
            $err_message = $err_string;
            $err_message .= "<br>";
            $err_message .= 'Line: ' . $err_line;
            $err_message .= "<br>";
            $err_message .= 'File: ' . $err_file;

        }
        self::showMessages($err_message, $err_number);
    }
    
    public static function showMessages($text, $error_num = 1)
    {
        $data['error'] = self::processMessages($text, $error_num);
        View::setThemeFile(false);
        $view = new View();
        $view->setData($data);
        $view->setFile('message','view');
        $view->render();
        exit;
    }
    
    public static function processMessages($text, $err_num)
    {
        $error_num = array(
            1	=> 'An Error Was Encountered',
            2	=> 'Fatal Error',
            3	=> 'Successfully',

            200	=> 'OK',
            201	=> 'Created',
            202	=> 'Accepted',

            300	=> 'Error 300:	Multiple Choices',
            301	=> 'Error 301: Moved Permanently',
            302	=> 'Error 302: Found',
            304	=> 'Error 304: Not Modified',
            305	=> 'Error 305: Use Proxy',
            307	=> 'Error 307: Temporary Redirect',

            400	=> 'Error 400: Bad Request',
            401	=> 'Error 401: Unauthorized',
            403	=> 'Error 403: Forbidden',
            404	=> 'Error 404: Page Not Found',
            405	=> 'Error 405: Method Not Allowed',
            406	=> 'Error 406: Not Acceptable',
        );

        if(is_numeric($err_num))
        {
            $error['title'] = (isset($error_num[$err_num]))? $error_num[$err_num]: $error_num[1];
            $error['message'] = str_replace(ROOT, 'ROOT', $text);
            return $error;
        }
        else
        {
            self::processMessages('Error type and number need to be only integer(numbers)!!!', 400);
        }
    }
}
