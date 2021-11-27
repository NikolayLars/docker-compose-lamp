<?php
session_start();
if($_SESSION['Rolle']==1){echo ('
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="fullBody">
        <div class="card"><div class="inner innerTopLeft" id="showall"></div></div>
        <div class="card"><div id="showallUsers"class="inner"></div></div>
        <div class="card"><div class="inner">
            <label for="bname"></label><input type="text" name="bname" id="bname">
            <label for="mail"></label><input type="email" name="mail" id="mail" step=0.01>
            <button onclick="postNewUser()">Hinzufügen</button>
        </div></div>
        <div class="card"><div class="inner">
            <label for="name"></label><input type="text" name="name" id="name">
            <label for="preis"></label><input type="number" name="preis" id="preis" step=0.01>
            <label for="anz"></label><input type="number" name="anz" id="anz" step=1>
            <button onclick="add()">Hinzufügen</button>
        </div></div>
    </div>

    <script src="hub.js"></script>
</body>
</html>

<link rel="stylesheet" href="hub.css">
    
    
    ');}
?>


