<?php

$serverName ="localhost";
$userName = "root";
$password = "";
$dbName = "basicdb2";

// create and check connection
if (!$conn = mysqli_connect($serverName, $userName, $password, $dbName)){
    die ("Failed to Connect");
}
?>