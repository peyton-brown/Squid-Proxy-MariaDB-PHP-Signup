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

function createUser($conn, $username, $password) {
  $sql = "INSERT INTO passwd(user, password) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($conn);

  // if stmt failes, send user back with an error
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header('location: ../signup.php?error=stmtFailed');
    exit();
  }

  // Makes a hashed password.
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header('location: ../signup.php?error=successfullySignedUp');
  exit();
}

?>
