<?php 
namespace JunMy\Components\ShoppingBasket;
/* 
SHOPPING BASKET CLASS 

USAGE: 
------ 

$cart = new ShoppingBasket; Initialize class 
$cart->SaveCookie(TRUE); Set option to save items ina cookie or not. Cookie valid for 1 day. 
$cart->AddToBasket('ITEM_ID', QTY); Add an item to the basket  
$cart->RemoveFromBasket('ITEM_ID', QTY); Remove item form basket 
$cart->DeleteFromBasket('ITEM_ID'); Removes all of item selected 
$cart->EmptyBasket('ITEM_ID' QTY); Clear the basket 
$cart->GetBasketQty(); Get qty of items in the basket 
$cart->GetBasket(); Returns basket items as an array ITEM_ID => QTY 

*/ 

/** 
 * ShoppingBasket 
 * 
 * A simple shopping basket class used to add and delete items from a session based shopping cart 
 * @package ShoppingBasket 
 * @author Dave Nicholson <dave@davenicholson.co.uk> 
 * @link http://davenicholson.co.uk 
 * @copyright 2008 
 * @version 0.1 
 * @access public 
 */ 
class ShoppingBasket { 

    public $cookieName = 'ckBasket'; 
    public $cookieExpire = 86400; // One day 
    public $saveCookie = TRUE; 

    /** 
     * ShoppingBasket::__construct() 
     * 
     * Construct function. Parses cookie if set. 
     * @return 
     */ 
    function __construct() { 
 

        if (!isset($_SESSION['cart']) && (isset($_COOKIE[$this->cookieName]))) { 
            $_SESSION['cart'] = unserialize(base64_decode($_COOKIE[$this->cookieName])); 
        } 

    } 

    /** 
     * ShoppingBasket::AddToBasket() 
     * 
     * Adds item to basket. If $id already exists in array then qty updated 
     * @param mixed $id - ID of item 
     * @param integer $qty - Qty of items to be added to cart 
     * @return bool 
     */ 
    function AddToBasket($id, $qty = 1) { 

        if (isset($_SESSION['cart'][$id])) { 
            $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $qty; 
        } else { 
            $_SESSION['cart'][$id] = $qty; 
        } 
        $this->SetCookie(); 
        return true; 
    } 

    /** 
     * ShoppingBasket::RemoveFromBasket() 
     * 
     * Removes item from basket. If final qty less than 1 then item deleted. 
     * @param mixed $id - Id of item 
     * @param integer $qty - Qty of items to be removed to cart 
     * @see DeleteFromBasket() 
     * @return bool 
     */ 
    function RemoveFromBasket($id, $qty = 1) { 

        if (isset($_SESSION['cart'][$id])) { 
            $_SESSION['cart'][$id] = $_SESSION['cart'][$id] - $qty; 
        } 

        if ($_SESSION['cart'][$id] <= 0) { 
            $this->DeleteFromBasket($id); 
        } 
         
        $this->SetCookie(); 
        return true; 
        exit(); 
    } 

    /** 
     * ShoppingBasket::DeleteFromBasket() 
     * 
     * Completely removes item from basket 
     * @param mixed $id 
     * @return bool 
     */ 
    function DeleteFromBasket($id) { 
        unset($_SESSION['cart'][$id]); 
        $this->SetCookie(); 
        return true; 
        exit(); 
    } 

    /** 
     * ShoppingBasket::GetBasket() 
     * 
     * Returns the basket session as an array of item => qty 
     * @return array $itemArray 
     */ 
    function GetBasket() { 
        if (isset($_SESSION['cart'])) { 
            foreach ($_SESSION['cart'] as $k => $v) { 
                $itemArray[$k] = $v; 
            } 
            return $itemArray; 
            exit(); 
        } else { 
            return false; 
        } 
    } 

    /** 
     * ShoppingBasket::UpdateBasket() 
     * 
     * Updates a basket item with a specific qty 
     * @param mixed $id - ID of item 
     * @param mixed $qty - Qty of items in basket 
     * @return bool 
     */ 
    function UpdateBasket($id, $qty) { 

        $qty = ($qty == '') ? 0 : $qty; 

        if (isset($_SESSION['cart'][$id])) { 
            $_SESSION['cart'][$id] = $qty; 

            if ($_SESSION['cart'][$id] <= 0) { 
                $this->DeleteItem($id); 
                return true; 
                exit(); 
            } 
            $this->SetCookie(); 
            return true; 
            exit(); 

        } else { 
            return false; 
        } 

    } 

    /** 
     * ShoppingBasket::GetBasketQty() 
     * 
     * Returns the total amount of items in the basket 
     * @return int quantity of items in basket 
     */ 
    function GetBasketQty() { 
        if (isset($_SESSION['cart'])) { 
            $qty = 0; 
            foreach ($_SESSION['cart'] as $item) { 
                $qty = $qty + $item; 
            } 
            return $qty; 
        } else { 
            return 0; 
        } 
    } 

    /** 
     * ShoppingBasket::EmptyBasket() 
     * 
     * Completely removes the basket session 
     * @return 
     */ 
    function EmptyBasket() { 
        unset($_SESSION['cart']); 
        $this->SetCookie(); 
        return true; 
    } 

  /** 
   * ShoppingBasket::SetCookie() 
   * 
   * Creates cookie of basket items 
   * @return bool 
   */ 
    function SetCookie() { 

        if ($this->saveCookie) { 
            $string = base64_encode(serialize($_SESSION['cart'])); 
            setcookie($this->cookieName, $string, time() + $this->cookieExpire, '/'); 
            return true; 
        } 
         
        return false; 
    } 
     
  /** 
   * ShoppingBasket::SaveCookie() 
   * 
   * Sets save cookie option 
   * @param bool $bool 
   * @return bool 
   */ 
    function SaveCookie($bool = TRUE) { 
        $this->saveCookie = $bool; 
        return true; 
    } 

} 
