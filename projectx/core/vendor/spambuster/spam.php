<?php
namespace projectx\core\vendor\spambuster;

/*
 * use projectx\core\vendor\spambuster;
 * 
 * $string = 'sexy mama on the beach';
 * $spam = new spambuster\spam($string);
 * if($spam->ValidateSpam() === true){ echo this is spam}
 * else{ // oke, do something with the data } 
 */

require_once 'config.php';

class spam
{
    private $_str;
    
    public function __construct( $string )
    {
        $this->_str = strtolower( $string );
    }
    
    public function ValidateSpam()
    {
        $string = trim( $this->_str );
        
        $string = preg_replace( '/\s+/', ' ', $string );
        
        $word_list= explode(" ", $string );
        
        foreach($word_list as $word)
        {
            if( isset($GLOBALS['bad_words'][$word]) )
            {
                return true;
            }    
        }
        return false;
    }
}
