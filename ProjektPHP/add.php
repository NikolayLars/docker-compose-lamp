<?php
session_start();
include_once("connectDB.php");
if($_SESSION["Rolle"]==1){
$name=$_GET['name'];
$preis=$_GET['preis'];
$anz=$_GET['anz'];
$oldName=$name;
$name="'$name'";
$preis="'$preis'";
$anz="'$anz'";



function checkForName($name){
    $sql = $GLOBALS['mysqli'] ->query ("SELECT * FROM produkte WHERE name = $name");
    $row = $sql->fetch_assoc();
    $rows = $sql -> num_rows;
    if($rows > 0){
        return true;
    }
    else{
        return false;
    }
}


if(!checkForName($name)){
$sql = $mysqli ->query ("INSERT INTO `produkte`(Name, Preis, Anzahl) VALUES ($name, $preis, $anz);");
}
}

