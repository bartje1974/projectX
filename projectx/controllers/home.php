<?php
namespace projectx\controllers;
use projectx\core\controller;
use projectx\core\vendor\auth\authentication;


class home extends controller
{
    protected $auth;
    protected $message;


    public function index()
    {
        $username = 'bart@cs-hosting.nl';
        $password = 'kwibus';
        $this->auth = new authentication;
        
        //$data = $this->auth->get_auth('users', $username, $password);
        
        //if($data == false)
        //{
          //  echo 'Something goes wrong with auth';
        //}
        
        
        if($this->auth->is_auth() === FALSE)
        {
            echo 'Not logged in!';
        }
        else
        {
            echo 'logged in!';
        }
        $this->auth->remove_auth();
         // $this->view('home');
    }  
}