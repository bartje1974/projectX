<?php
namespace projectx\core;
/**
 * Description of config
 *
 * @author bart
 */
class config {
    
    private $_properties = array(); 

    public function __construct() { 
        $this->_properties = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/projectx/core/config/config.ini', true); 
    } 

    public function get($name) { 
        if(strpos($name, ".")) { 
            list($section_name, $property) = explode(".", $name); 
            $section =& $this->_properties[$section_name]; 
            $name = $property; 
        } else { 
            $section =& $properties; 
        } 

        if(is_array($section) && isset($section[$name])) { 
            return $section[$name]; 
        } 
        return false; 
    } 

} 