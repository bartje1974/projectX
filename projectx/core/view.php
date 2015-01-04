<?php
namespace projectx\core;

/**
 * Description of view
 *
 * @author bart
 */
class view 
{
    public function render($file, $variables = '') 
    {
        if(is_array($variables))
        {
            extract($variables);
        }
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'].'/projectx/views/template/header.php';
        include $_SERVER['DOCUMENT_ROOT'].'/projectx/views/'.$file.'.php';
        include $_SERVER['DOCUMENT_ROOT'].'/projectx/views/template/footer.php';
        ob_flush();
    }
}