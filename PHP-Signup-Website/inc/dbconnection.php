<?php

$dbServerName="localhost";
$dbUsername="squidUser";
$dbPassword="squidPassword";
$dbName = "squid";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

/* Check the connection is created properly or not */
if(!$conn){
    echo "Connection error:" . mysqli_connect_error();
} else {
    echo "Connection is created successfully";
}

?>
