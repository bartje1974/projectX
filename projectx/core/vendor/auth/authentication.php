<?php
namespace projectx\core\vendor\auth;
use projectx\core\vendor\encryption\password;
use projectx\core\vendor\orm\db;
use projectx\core\session;
/**
 * Description of authentication
 *
 * @author bart
 */
class authentication 
{
    protected $message;
    protected $password;
    protected $db;
    protected $auth;
    
    private $_passwd;
    private $_id;


    public function __construct() 
    {
        $this->password = new password;
        $this->db       = new db;
        $this->auth     = new session;
        $this->auth->start();
    }
    
    public function get_auth($tablename, $usernameFromPost, $passwordFormPost)
    {
        $q = "SELECT * FROM ";
        $q.= $tablename;
        $q.= " WHERE ";
        $q.= "email =";
        $q.= $this->db->escape($usernameFromPost);
        //echo 'passsword: '.$password;
        //echo $q;
        $result = $this->db->query($q)->fetchColumn();
        
        if($result >= 0)
        {
            $result = $this->db->query($q);
            
            foreach ($result as $row) 
            {
                $this->_id = $row['id'];
                $this->_passwd = $row['password'];
            }
            
            $pwd = $this->password->getpasswd($passwordFormPost, $this->_passwd);
            if($pwd === false)
            {
                return FALSE;
            }
            else
            {
                $this->auth->set('logged_in', true);
                $this->auth->set('user_id', $this->_id);
                
                return true;
            }
        }
        else
        {
            return false;
        }      
    }
    
    public function is_auth()
    {
        if($this->auth->get('logged_in') == false)
        {
            return FALSE;
        }
    }
    
    public function remove_auth()
    { 
        $this->auth->destroy();
    }
}