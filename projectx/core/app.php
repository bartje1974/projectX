<?php
namespace projectx\core;

/**
 * Description of app
 *
 * @author bart
 */
class app
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $segments = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/projectx/controllers/'.$url[0].'.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        $use = '\\'.'projectx\controllers'.'\\'.$this->controller;
        $this->controller = new $use();

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $method = $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->segments = $url ? array_values($url) : [];
        call_user_func_array(array( $this->controller, $this->method), $this->segments);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
