<?php

$server="localhost";
$username="squidUser";
$password="squidPassword";
$database = "squid";

$conn = mysqli_connect($servername, $username, $password, $database);

/* Check the connection is created properly or not */
if(!$conn){
    echo "Connection error:" . mysqli_connect_error();
} else {
    echo "Connection is created successfully";
}

?>
