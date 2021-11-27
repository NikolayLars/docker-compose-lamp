<?php
session_start();
require_once("connectDB.php");
if($_SESSION['Rolle']==1){
    $sql = $mysqli ->query ("SELECT Benutzername, Email FROM benutzer");
    $result = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo "<table>";
    echo "<tr>";
    echo "<th>Benutzername</th>";
    echo "<th>Email</th>";
    echo "</tr>";
    foreach($result as $row){
        echo "<tr>";
        echo "<td>".$row['Benutzername']."</td>";
        echo "<td>".$row['Email']."</td>";
        echo "</tr>";
    }
    echo "</table>";
}