<?php

session_start();
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
<h1>Willkommen <?php echo $_SESSION['Benutzername']; ?></h1>
    <div id="showall">
        
    </div>
    <div id="cart">

    </div>
    
<script src="hub.js"></script>
</body>
</html>

<link rel="stylesheet" href="shop.css">