<?php
namespace projectx\core\vendor\message;
use projectx\core\session;
/**
 * Description of flashmessage
 * use projectx\core\vendor\message\flashmessage;
 * 
 * $data['ok'] = 'Mail is verzonden!';
 * $data['msg'] = 'We nemen zo contact op';
 * We have 4 options: s = success w = warning i = info e = error
 * 
 * $this->message->add('s', $data);
 * 
 * @author bart
 */
class flashmessage 
{
    protected $message;
    private $_type;
    private $_message;
    
    public function __construct() 
    {
        $this->message = new session;
    }
    
    public function add($type, $message)
    {
        $searce = array('s', 'e', 'i', 'w'); 
        $replace = array('cool', 'error', 'info', 'warning');       
        $types = str_replace($searce, $replace, $type );
        
        $this->_type    = $types;
        $this->_message = $message;
        
        $this->message->set($this->_type, $this->_message);
    }
    
    public function get_message()
    {
        $data = '';
        if($this->message->get($this->_type))
        {
            
            $data.='<div class="'.$this->_type.'">';
            foreach ($this->message->get($this->_type) as $value) 
            {
                $data.= '<li>';
                $data.= $value;
                $data.= '</li>';
            }
            $data.='</div>';
        }
        
        return $data;
    }
}
