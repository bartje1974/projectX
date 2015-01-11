<?php
namespace projectx\controllers;
use projectx\core\controller;
use projectx\core\vendor\cart\cart;

class shop extends controller
{
    protected $cart;
    
    public function __construct() {
        $this->cart = new cart;
    }

    public function index()
    {
        //$this->cart->add('SKU01012015', 45.33, 'boat', 2);
        //$this->cart->add('SKU10230032', 4.21, 'duck',  4);
        $this->cart->delete();
        echo 'Aantal items in winkelwagen: '.$this->cart->inbasket();
        $items = $this->cart->getcontents();
        echo '<table>';
        foreach ($items as $v)
        {
            
            echo '<tr>';
            echo '<td>'.$v['name'].'</td>'.'<td>'.$v['qty'].'</td>'.'<td align="right">'.$v['price'].'</td>';
            echo '</tr>';
        }
        echo '<tr>';
            echo '<td></td>'.'<td>Totaal &euro;</td>'.'<td align="right">'.$this->cart->total().'</td>';
            echo '</tr>';
        echo '</table>';
    }
    
}