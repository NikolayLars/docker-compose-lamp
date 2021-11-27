<?php

session_start();
require_once("connectDB.php");
if ($_SESSION['Rolle']==1) {
$delete = $_GET['name'];
delete($delete);

}

function delete($delete){
    $sql = $GLOBALS['mysqli'] ->query ("DELETE FROM produkte WHERE name = '$delete'");
}