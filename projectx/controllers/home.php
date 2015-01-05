<?php
namespace projectx\controllers;
use projectx\core\controller;
use projectx\core\vendor\auth\acl;


class home extends controller
{
    protected $acl;
    protected $message;


    public function index()
    {
        $actions = array(
                        'read',
                        'write',
                        'publish',
                        'delete'
                    );

        $this->acl = new acl($actions);
        
        $this->acl->addPermission('read');
        $this->acl->addPermission('write');
        $this->acl->addPermission('delete');
        $this->acl->addPermission('publish');
        
        $code = $this->acl->evaluate();
        
        echo $code;
        
    }
}