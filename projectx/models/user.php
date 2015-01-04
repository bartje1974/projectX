<?php
namespace projectx\models;
use projectx\core\vendor\orm;
/**
 * Description of user
 *
 * @author bart
 */
class user {
    
    private $crud;
    public function __construct() 
    {
        $this->crud = new orm\db();
    }

    public function getUsers($id) 
    {
       
       $result = $this->crud->query("SELECT * FROM users WHERE id=".$this->crud->escape($id)."");
       return $result;
    }
    
    
    public function CreateUser($user, $password)
    {
        $data = array('username' => $user, 'password' => $password);
        return $this->crud->insert('users', $data);
    }


    public function DeleteUser($table, $id, $val)
    {
        $this->crud->delete($table, $id, $val);
    }
    
}
