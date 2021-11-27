<?php
session_start();
if($_SESSION["Rolle"]==1){
include_once("connectDB.php");
$sql = $mysqli ->query ("INSERT INTO `produkte`(Name, Preis, Anzahl) VALUES ('Tisch','66.99','4')");
}