<?php

include_once 'dbconnection.php';

$uid = $_POST['uid'];
$pwd = $_POST['pwd'];

$sql = "INSERT INTO passwd (user, password) VALUES ('$uid', '$pwd');";
$result = mysqli_query($conn, $sql)

header('location: ../index.php?signup=success');

?>
