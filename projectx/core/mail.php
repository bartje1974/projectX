<?php
namespace projectx\core;

/**
 * Description of mail
 * auto config mail
 * $this->mail->automail();
 * optional if not want to use the config settins
 * $this->mail->from('bartje1974@hotmail.com', 'Bart van Berkel');
 * $this->mail->to('bart@cs-hosting.nl', 'Bart');
 *
 * $this->mail->subject('Testing mail');
 * // mind in config set ishtml to true if html needed!
 * $this->mail->message('Hello World. this is a test');
 * $this->mail->send();
 *
 * @author bart
 */
class mail
{
    private $_sitename;
    private $_from;
    private $_to;
    private $_bcc;
    private $_subject;
    private $_messsage;
    private $_Ishtml;
    private $_totalmail;

    private $config;

    public function __construct()
    {
        $this->config    = new config();
        $this->_sitename = $this->config->get('sitename.name');
    }

    public function automail()
    {
        $this->_from['from_mail']  = $this->config->get('email.mail');
        $this->_from['from_name']  = $this->config->get('email.name');
        $this->_Ishtml = $this->config->get('email.ishtml');
        //echo $this->_Ishtml;
    }

    public function from($email, $name = '')
    {
        $this->_from['from_mail'] = $email;
        $this->_from['from_name']  = $name;
    }

    public function test()
    {
        //print_r($this->_to);
        //echo $this->_messsage;
    }

    public function to($mail, $name = '')
    {
        $this->_to['to_mail'] = $mail;
        $this->_to['to_name'] = $name;
    }

    public function bcc($bccmail, $bcc)
    {
        $this->_bcc['bcc_mail'] = $bccmail;
        $this->_bcc['bcc']      = $bcc;
    }

    public function subject($subject)
    {
        $this->_subject = $subject;
    }

    public function message($message)
    {
        $this->_messsage = $message;
    }

    public function SetHtml()
    {
        $html = '<html>'.PHP_EOL;
        $html .= '<head>'.PHP_EOL;
        $html .= '<meta charset="utf-8">'.PHP_EOL;
        $html .= '<title>'.$this->_subject.'</title>'.PHP_EOL;
        $html .= '<body>'.PHP_EOL;
        $html .= wordwrap($this->_messsage, 70).PHP_EOL;
        $html .= '</body'.PHP_EOL;
        $html .= '</html>'.PHP_EOL;

        return $html;
    }

    public function BuildMail()
    {
        if ($this->_Ishtml == 1) {
            $this->_totalmail = $this->SetHtml();
        } else {
            $this->_totalmail = $this->_messsage;
        }

        return $this->_totalmail;
    }

    public function send()
    {
        if (!mail($this->_to['to_mail'], $this->_subject, $this->BuildMail(), $this->headers())) {
            echo 'mail not send!';
        } else {
            echo 'Mail send';
        }
    }

    public function Is_html()
    {
        if ($this->_Ishtml == 1) {
            return true;
        }
    }

    private function headers()
    {
        $headers = 'From: '.$this->_sitename.' <'.$this->_from['from_mail'].'>'."\r\n";
        $headers .= 'Reply-To: '.$this->_from['from_name'].' <'.$this->_from['from_mail'].'>'."\r\n";
        $headers .= 'Return-Path: Mail-Error <'.$this->_from['from_mail'].'>'."\r\n";
        $headers .= ($this->_bcc['bcc_mail'] != '') ? 'Bcc: '.$this->_bcc['bcc_mail']."\r\n" : '';
        $headers .= 'X-Mailer: PHP/'.phpversion()."\r\n";
        $headers .= 'X-Priority: Normal'."\r\n";
        $headers .= ($this->Is_html()) ? 'MIME-Version: 1.0'."\r\n" : '';
        $headers .= ($this->Is_html()) ? 'Content-type: text/html; charset=UTF-8'."\r\n" : '';

        return $headers;
    }
}
