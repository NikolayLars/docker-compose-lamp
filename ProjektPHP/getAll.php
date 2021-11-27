<?php

require_once("connectDB.php");

$sql = $mysqli ->query ("SELECT Name, Preis, Anzahl FROM produkte");

$result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
echo json_encode($result);