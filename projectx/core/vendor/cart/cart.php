<?php
namespace projectx\core\vendor\cart;
use projectx\core\session;
/**
 * Description of cart
 *
 * @author bart
 */
class cart 
{ 
    protected $session;
    
    private $items = array(); // Associative array of items 

    function __construct() 
    {
        $this->session = new session;
        $this->session->start();
    } 

    public function add($itemID, $price, $name, $qty = 1) 
    { 
        if (isset($this->items[$itemID])) 
        { 
            $this->items[$itemID]['qty'] += (int)$qty; 
        }
        else 
        {
            $this->items[$itemID]['id']    = $itemID;
            $this->items[$itemID]['qty']   = (int)$qty; 
            $this->items[$itemID]['price'] = $price; 
            $this->items[$itemID]['name']  = $name;
        } 
         
        // Sync the session with the cart now 
        $this->syncSessionToCart(); 
    } 
     
    public function remove($itemID) 
    {   
        unset($_SESSION['items'][$itemID]);
        //$this->syncSessionToCart();
    } 
     
    public function update($itemID, $newQuantity) 
    { 
        if (isset($_SESSION['items'][$itemID])) 
        { 
            if ((int)$newQuantity <= 0) 
            { 
                $this->remove($itemID); 
                //echo 'remove';
            } 
            else 
            { 
                $_SESSION['items'][$itemID]['qty'] = (int)$newQuantity; 
            } 
        } 
    } 
     
    public function getQuantity($itemID) 
    { 
        if (isset($this->items[$itemID])) 
        { 
            return ($this->items[$itemID]['qty']); 
        } 
    } 
     
    public function itemsInBasket() 
    { 
        if (isset($_SESSION['items'])) 
        { 
            $numberOfItems = count($_SESSION['items']);
            
            return $numberOfItems; 
        } 
    } 
     
    public function emptyCart() 
    { 
        unset($this->items); 
         
        $this->items = array(); 
         
        // Sync the session with the cart now 
        $this->syncSessionToCart(); 
    } 

    public function getContents() 
    { 
        if (isset($_SESSION['items'])) 
        { 
            return $_SESSION['items']; 
        } 
    } 

    public function getTotal() 
    { 
        if (isset($_SESSION['items'])) 
        { 
            $total = '';
         
            foreach ($_SESSION['items'] as $item) 
            { 
                $total += $item['price'] * $item['qty']; 
            } 
            
            
            return number_format((float)$total, 2, '.', '');
        } 
        else 
        { 
            return 0; 
        } 
    } 
    
    private function syncSessionToCart() 
    { 
        $_SESSION['items'] = array_merge($this->items); 
    } 
}  