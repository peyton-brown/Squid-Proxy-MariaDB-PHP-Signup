<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "squid";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if($conn->connect_error)
    echo "Connection error:" .$conn->connect_error;
else
    echo "Connection is created successfully";

?>
