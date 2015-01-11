<?php
namespace projectx\core;
use PDO;
use projectx\core\config;
class database extends PDO
{
    public function __construct() 
    {
        $config = new config();
        parent::__construct($config->get('database.driver').':host=localhost;'.'dbname='.$config->get('database.dbname'), $config->get('database.username'), $config->get('database.password'));
       
    }
}