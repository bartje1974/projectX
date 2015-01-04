<?php
namespace projectx\controllers;
use projectx\core\controller;
use projectx\core\vendor\forms\form;
use projectx\core\vendor\smiles\smile;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author bart
 */
class home extends controller
{
    // place a protected var form to use form... $this->form = new form in the constructor;
    public function index()
    { 
        $users = $this->model('user');
        //$users->DeleteUser('users', 'id', 5);
        $users->CreateUser('senna', 'woef');
        $this->redirect('home/show');   
    }
    
    public function show($id)
    {
        $users = $this->model('user');
        $data = array('result' => $users->GetUsers($id));
                
        $this->view('home', $data);
    }
    
    public function formulieren()
    {
        //Set rules for the 'name' field
        $field = 'name';
        $validationRules = array(      
                               'required' => TRUE,
                               'minLength' => 2,
                               'maxLength' => 15,
                               'alphaNumeric' => TRUE
                           );
        
        $this->form->setValidation($field, $validationRules);
        
        $field ='email';
        $validationRules = array(
                                'required' =>true,
                                'validEmail' => true
                                );
        
        $this->form->setValidation($field, $validationRules);
        
        
        $field ='test';
        $validationRules = array(
                                'required' =>true,
                                'minLength' => 50,
                                );
        
        $this->form->setValidation($field, $validationRules);
        
        
        //Validate the fields (has to be called after the validationRules have been set and before the fields)
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($this->form->validateFields($_POST))
            {
                //validateFields() returns TRUE, Process the data in a database
                    $users = $this->model('user');
                    $users->CreateUser( $_POST['name'], $_POST['email']);
                    echo 'OK!';
            }
        }
        
        $data['form'] = $this->form;
        
        $this->view('home', $data);  
    }
    
    public function smilieexample()
    {
        $this->smile = new smile;
          $data['sml'] = $this->smile->Get_smile();
          $this->view('home', $data);
    }
}
