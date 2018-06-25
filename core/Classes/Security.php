<?php
namespace Core\Classes;

class Security {
    // statics
    // xss_clean
    // hash
    // clean_input*** TODO
    // 
    
    
    public static function cleanInput($value = null)
    {
        if (empty($value)) {
            return null;
        }
    	$addslashes=addslashes($value);
    	$htmlspecialchars=htmlspecialchars($addslashes, ENT_QUOTES);
    	return trim($htmlspecialchars);
    }
    
    private static function runFilters($value)
    {
    	
        $filters = array('<script','<a', '<?','</script>','</a>','?>');
        
        foreach($filters as $filter) {
    		if(strstr($value, $filter)) {
    			$value = str_replace($filter, '', $value);
    		}
        }
	
    }
}
