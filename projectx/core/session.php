<?php
namespace projectx\core;

/*
 * $session = new session;
 * $session->start();
 * $data1 = array('name' => 'ilona', 'age' => 34);
 * //$session->set('test', $data1);
 * //echo $session->get('test', 'name');
 * $session->destroy();
 * $session->display();
 */
class session
{
    private $_sess = false;

    public function start()
    {
        if ($this->_sess == false) {
            session_start();
            $this->_sess = true;
        }
    }

    // $_SESSION[$key]= $value;
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key, $secondkey = false)
    {
        if ($secondkey == true) {
            if (isset($_SESSION[$key][$secondkey])) {
                return $_SESSION[$key][$secondkey];
            }
        } else {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }
        }

        return false;
    }

    public function destroy()
    {
        if ($this->_sess == true) {
            session_unset();
            session_destroy();
        }
    }

    public function display()
    {
        if (isset($_SESSION)) {
            echo '<pre>';
            print_r($_SESSION);
            echo '</pre>';
        }
    }
}
