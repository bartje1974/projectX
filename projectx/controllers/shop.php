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
        $this->cart->add('SKU01012015', 45.33, 'boat', 2);
        echo 'Aantal items in winkelwagen: '.$this->cart->itemsInBasket();
        $items = $this->cart->getContents();
        echo '<table>';
        foreach ($items as $v)
        {
            
            echo '<tr>';
            echo '<td>'.$v['name'].'</td>'.'<td>'.$v['qty'].'</td>'.'<td align="right">'.$v['price'].'</td>';
            echo '</tr>';
        }
        echo '<tr>';
            echo '<td></td>'.'<td>Totaal &euro;</td>'.'<td align="right">'.$this->cart->getTotal().'</td>';
            echo '</tr>';
        echo '</table>';
    }
    
}