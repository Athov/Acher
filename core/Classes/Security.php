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
 * Security class.
 *
 * @author Atanas Harapov <atanas.harapov@abv.bg>
 */
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
