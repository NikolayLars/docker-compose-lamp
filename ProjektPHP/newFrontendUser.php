<?php
session_start();
require_once("connectDB.php");

if($_SESSION['Rolle']==1){
$_POST = json_decode(file_get_contents("php://input"), true);
$pw = generateRandomPassword();
echo($pw);

$name = $_POST['name'];
$email = $_POST['email'];
createBenutzer($name, $email, $pw);
createRollen($name, $email);
}


function createBenutzer($name, $email, $pw) {
    $sql = "INSERT INTO benutzer (benutzername, passwort, email) VALUES ('$name', '$pw', '$email')";
    $result = mysqli_query($GLOBALS['mysqli'], $sql);
}   
function createRollen($name, $email) {
    $sql = "INSERT INTO rollen (benutzer_id) VALUES ((SELECT id FROM benutzer WHERE benutzername = '$name' AND email = '$email'))";
    $result = mysqli_query($GLOBALS['mysqli'], $sql);
}

function generateRandomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function sendMail($email, $password) {
    $to = $email;
    $subject = "Ihr Passwort";
    $message = "Ihr Passwort lautet: " . $password;
    mail($to, $subject, $message);
}
//Keinen Mailserver angegeben, daher einfach vorstellen
//sendMail($_POST['email'], generateRandomPassword());