<?php
use spambuster\Spam;

require 'spambuster.class.php';

$str = 'Hello WorlD! ';

$spam = new Spam($str);
if($spam->ValidateSpam() === true)
{
    echo 'spam';
}
else
{
    echo 'NO spam';
}


?>
