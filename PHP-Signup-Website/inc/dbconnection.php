<?php

$serverName = "localhost";
$dbUsername = "squidUser";
$dbPassword = "password";
$dbName = "squid";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  die("MySQLi failed: " . mysqli_connect_error());
}

?>
