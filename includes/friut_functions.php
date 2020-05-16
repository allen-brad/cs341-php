<?php
function searchForFruitByName($name, $array) {
    foreach ($array as $key => $val) {
        if ($val['name'] === $name) {
            return $key;
        }
    }
    return null;
 }

 function getItemCostByName($name) {
    foreach ($fruits as $fuit) {
        if ($fuit['name'] === $name) {
            return 'yeah buddy <br>';
        }
    }
    return null;
 }

 function searchCartByItem($item) {
    foreach ($_SESSION['cart'] as $key => $val) {
        if ($val['product'] === $item) {
            return true;
        }
    }
    return false;
 }

 function updateQuantityInCart($product, $quantity){
    foreach($_SESSION['cart'] as &$value){
        if($value['product'] === $product){
            $value['quantity'] += $quantity;
            unset($value); // value is passed by reference by using &above so destroy $value so we don't accidentally change it later
            break; // Stop the loop after we've found the item
        }
    }
 }
 function removeFromCart($item){
    $key = array_search($item, array_column($_SESSION['cart'], 'product'));
    unset($_SESSION['cart'][$key]);
 }

 function itemCountInCart(){
    $totalItems = 0;
    if ( isset($_SESSION['cart']) ) {
        foreach($_SESSION['cart'] as $item){
                $totalItems += $item['quantity'];
        }
    }
    return $totalItems;  
 }
 ?>