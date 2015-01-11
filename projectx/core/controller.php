<?php
namespace projectx\core;

/*
 * Description of controller
 *
 * @author bart
 */
class controller
{
    protected $model;

    public function model($model)
    {
        $use = '\\'.'projectx\models'.'\\'.$model;

        return $this->model = new $use();
    }

    public function view($view, $data = '')
    {
        $screen = new view();

        return $screen->render($view, $data);
    }

    public function redirect($url)
    {
        $config = new config();
        header('Location:'.$config->get('baseurl.url').$url.'/');
        exit();
    }
}
