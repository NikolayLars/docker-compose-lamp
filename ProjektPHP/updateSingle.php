<?php
session_start();
include_once("connectDB.php");
if($_SESSION["Rolle"]==1){
$change = $_GET["change"];
$withWhat = $_GET["withWhat"];
$old = $_GET["old"];
$withWhat = "'$withWhat'";
$old = "'$old'";


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


if(!checkForName($withWhat)){
    $sql = $mysqli ->query ("UPDATE produkte SET $change = $withWhat WHERE name = $old;");

    echo "UPDATE produkte SET $change = $withWhat WHERE name = $old;";
}

}