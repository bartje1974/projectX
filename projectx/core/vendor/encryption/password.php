<?php
namespace projectx\core\vendor\encryption;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of password
 *
 * @author bart
 */
class password 
{
    private $_option;
    
    public function __construct() 
    {
        $this->_option = array(12);
    }

    public function makepasswd( $passwordFromPost )
    {
       $hash = password_hash($passwordFromPost, PASSWORD_BCRYPT, $this->_option); 
       return $hash;
    }
    
    public function getpasswd( $passwordFromPost, $hashedPasswordFromDB )
    {
        if (password_verify($passwordFromPost, $hashedPasswordFromDB))
        {
            return true;   
        }
        else
        {
            return false;
        }     
    }
    
    public function CheckIfrehashNeeded($hashedPasswordFromDB)
    {
        if (password_needs_rehash($hashedPasswordFromDB, PASSWORD_BCRYPT, $this->_option)) 
        {
            $hashNew = password_hash($hashedPasswordFromDB, PASSWORD_BCRYPT, $this->_option);
            
            // needs to insert in a dynamic way 
            return $hashNew;
        }
    }
}