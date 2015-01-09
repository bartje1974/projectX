<?php
namespace projectx\models;
use projectx\core\vendor\encryption\password;
use projectx\core\vendor\orm\db;
/**
 * Description of user
 * A basic authentication example.
 *
 * @author bart
 */
class user {
    
    // Set a protected to initate the auth class
    protected $user;
    // This table is used where te users are stored if you use the example.
    protected $table = 'users'; 
    // Set protected to initate the password clas 
    // this you use to create a password and check if the password is valid.
    protected $password;
    // to register a user you can use the regular database things. ;)
    protected $db;


    public function __construct() 
    {
        $this->password = new password;
        $this->db       = new db;
    }
    
    
    public function createUser($username, $email, $password)
    {
        $data = array('username'   => $username,
                      'email'      => $email,
                      'password'   => $this->password->makepasswd($password),
                      'created_at' => date('Y-d-m h:i:s'),
                      'login_hash' => uniqid());
        
        $newuser = $this->db->insert($this->table, $data);
        return $newuser;
    }
 
}