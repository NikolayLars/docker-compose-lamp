<?php
session_start();
require_once('connectDB.php');

if(isset($_SESSION['Benutzername'])){
    
$cart = $_GET['cart'];

$cart = json_decode($cart);
echo $cart[0]->name;
echo $cart[0]->preis;
 removeItemsFromDatabase();
}
 function removeItemsFromDatabase() {
    

    $index = 0;
    for ($i=0; $i < count($GLOBALS['cart']); $i++) { 
        $name = $GLOBALS['cart'][$i]->name;
        $preis = $GLOBALS['cart'][$i]->preis;
        $sql = $GLOBALS['mysqli'] ->query ("UPDATE produkte SET anzahl = anzahl - 1 WHERE name = '$name' AND preis = '$preis'");
        
    }
    /*foreach ($GLOBALS['cart'] as $item) {
        $name = $GLOBALS[$i]->name;
        $preis = $GLOBALS[$i]->preis;
        $sql = $GLOBALS['mysqli'] ->query ("UPDATE producte SET anzahl = anzahl - 1 WHERE name = '$name' AND preis = '$preis'");
        echo "UPDATE producte SET anzahl = anzahl - 1 WHERE name = '$name' AND preis = '$preis'";
    }*/
 }