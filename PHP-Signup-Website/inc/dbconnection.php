<?php

$serverName = "localhost";
$dbUsername = "squidUser";
$dbPassword = "squidPassword";
$dbName = "squid";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  die("MariaDB failed: " . mysqli_connect_error());
}

?>
