<?php
require_once("connectDB.php");


    if (!empty($_POST)) { 
    $name = $_POST['name'];
    $pw = $_POST['pw'];
    $em = $_POST['em']; 

    $name = "'$name'";
    $pw = "'$pw'";
    $em = "'$em'";

    $sql = $mysqli ->query ("SELECT Benutzername, Passwort, Email FROM benutzer WHERE Benutzername = $name AND Passwort = $pw AND Email = $em");

    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    $rows = $sql -> num_rows;
    if($rows ===1) {
        session_start();
        $_SESSION['Benutzername'] = $result[0]["Benutzername"];
        $_SESSION['Email'] = $result[0]["Email"];
        require_once("rollenValidator.php");
        if($_SESSION["Rolle"]==1){
        header('location: http://localhost/ProjektPHP/hub.php');
        }
        else{
        header('location: http://localhost/ProjektPHP/shop.php');
        }
    } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
            <label for="Name">Name:</label><input id="Name" type="text" name="name" id="">
            <label for="Passwort">Passwort:</label><input id="Passwort" type="password" name="pw" id="">
            <label for="Email">Email:</label><input id="Email" type="email" name="em" id="">
            <input type="submit" value="Login">
        </form>
</body>
</html>

    




