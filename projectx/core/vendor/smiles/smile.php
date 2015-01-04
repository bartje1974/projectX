<?php
namespace projectx\core\vendor\smiles;
require_once 'conf.php';
    /** 
 * Replace the text smilies with images
 * @access   public
 * @param    string   $value
 * @return   string
 */
class smile
{
    public function parse_smile($value) 
    {
	$config = GetVar();
	$smileys = $config['images'];

        foreach($smileys as $key => $val) 
	{
            $value = str_replace($key, '<img src="' . $config['path'] . $smileys[$key][0] . '" width="' . $smileys[$key][1] . '" height="' . $smileys[$key][2] . '" alt="' . $smileys[$key][3] . '" style="border:0;" />', $value);
	}

            return $value;        
    }

    public function Get_smile()
    {
        $config = GetVar();
        $smileys = $config['images'];

        $html  = '<div id="emoticons">';		

        foreach($smileys as $key => $val ) 
	{
            $html .= '<a href="javascript:void(0)" title="'.$key.'"><img src="' . $config['path'] . $smileys[$key][0] . '" width="' . $smileys[$key][1] . '" height="' . $smileys[$key][2] . '" alt="' . $smileys[$key][3] . '" style="border:0;" /></a>'.PHP_EOL;
        }
            $html .= '</div>';

            return $html;
    }
}