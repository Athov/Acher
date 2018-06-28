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
 * Validation class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
class Validation 
{
    private static $instance = null;
    private $language = null;
    private $data = array();
    private $errors = array();
    
    public function __construct()
    {
        $this->language = new Language();
        $this->language->set('english');
    }

    public function setRules($post, $label, $rules)
    {
        $this->data[$post]['label'] = $label;
        $this->data[$post]['postdata'] = Input::data('POST', $post);
        $this->data[$post]['rules'] = explode('|', $rules);
        return $this;
    }
    
    public function run()
    {
        foreach (array_keys($this->data) as $key) {
            if($this->isEmpty($key)) {
                $this->getRule($key);
            }
        }
        return empty($this->errors);
    }
    
    public function getRule($key)
    {
        $value = $this->value($key);
        foreach ($this->data[$key]['rules'] as $rule) {
            
            preg_match('#\[(.*)\]#', $rule, $param);
            $rule_name = explode('[', $rule);
            
            $args = explode(',', @ $param[1]);
            
            $call_data = array_merge(array($value), array_filter($args));
            
            if(!\function_exists($rule_name[0]) && \method_exists($this, $rule_name[0] . 'Rule'))
            {
                $call = call_user_func_array(array($this, $rule_name[0] . 'Rule'), $call_data);
            } else {
                $call = call_user_func_array($rule_name[0], $call_data);
            }
            
            $data = array($rule_name[0], $key, $this->data[$key]['label'], $args);
            
            if (!$this->checkErrors($call, $data)) {
                break;
            }
            
        }
    }
    
    private function isEmpty($var)
    {
        if(is_null($var) or $var === false or $var === '' or $var === array())
        {
            return false;
        }
        return true;
    }
    
    public function getErrors($key = null)
    {
        if($this->isEmpty($key)){
            $errors = (array) $this->errors[$key];
        } else {
            $errors = $this->errors;
        }
        return $errors;
    }
    
    private function checkErrors($returned, $data)
    {
        if($returned == false)
        {
            $data[0] = strtolower($data[0]);
            $this->errors[strtolower($data[1])] = $this->language->translate('validation.' . $data[0], array_merge(array($data[2]), $data[3]));
            return false;
        }
        
        return true;
    }
    
    private function value($key)
    {
        return (isset($this->data[$key]['postdata'])) ? $this->data[$key]['postdata'] : null;
    }
    
    public function requiredRule($value)
    {
        return $this->isEmpty($value);
    }
    
    public function validEmailRule($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    
    public function betweenRule($value, $min, $max, $included = false)
    {
        $value = (int) $value;
        $min = ($included) ? $min - 1 : $min;
        $max = ($included) ? $max + 1 : $max;
        if($min < $value && $value < $max)
        {
            return true;
        }
        return false;
    }
}
