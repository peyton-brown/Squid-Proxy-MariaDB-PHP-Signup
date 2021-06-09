<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "squid";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  die("MySQLi failed: " . mysqli_connect_error());
}

?>
