<?php

// Signup.php


// If any of the following are true, it will send the user back to signup.php

// Checks if any of the signup details are left empty
// If any of these return true, the user left something empty
function emptyEntrie($userName, $password) {
  $result;
  if (empty($userName) || empty($password)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}


// Checks if the username only has a-z or A-Z or 0-9
function invalidUserName($userName) {
  $result;
  if (!preg_match('/^[a-zA-Z0-9]*$/', $userName)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function createUser($conn, $userName, $password) {
  $sql = "INSERT INTO passwd(user, password) VALUES (?, ?);";
  $result = mysqli_query($conn, $sql)

  header('location: ../signup.php?=successfullySignedUp');
  exit();
}

?>
