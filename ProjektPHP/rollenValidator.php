<?php
session_start();
require_once("connectDB.php");

$name = $_SESSION['Benutzername'];
$em = $_SESSION['Email'];

$name = "'$name'";
$em = "'$em'";







$sql = $mysqli ->query ("SELECT Rolle FROM rollen WHERE Benutzer_ID = (SELECT ID FROM benutzer WHERE Benutzername = $name AND Email = $em)");



    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);

    

        $_SESSION["Rolle"] = $result[0]["Rolle"];

    