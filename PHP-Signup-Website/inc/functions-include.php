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


function userNameExists($conn, $userName) {
  $sql = "SELECT * FROM passwd WHERE user = ?;";
  $stmt = mysqli_stmt_init($conn);

  // if stmt failes, send user back with an error
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header('location: ../signup.php?error=stmtFailed');
    exit();
  }
  // "ss" means two strings, "sss" means three strings
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  // if anything is using $resultData, then grab data from database so you
  // don't have duplicate users.
  // if this returns as false, it returns a good result
  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $password) {
  $sql = "INSERT INTO users (user, password) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($conn);

  // if stmt failes, send user back with an error
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header('location: ../signup.php?error=stmtFailed');
    exit();
  }

  // Makes a hashed password.
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ss",$username, $hashedPassword);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header('location: ../signup.php?error=successfullySignedUp');
  exit();
}






// login.php

// Same thing as the other emptyEntrie function,
// just with less variables being checked.

function emptyEntrieLogin($username, $password) {
  $result;
  if (empty($username) || empty($password)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

// Using the function at line 59, userNameExists

function loginUser($conn, $username, $password) {
  // Sends username back here from the function.
  $uidExists = userNameExists($conn, $username, $username);

  if ($uidExists === false) {
    header('location: ../login.php?error=userNameDoesNotExist');
    exit();
  }

  $hashedPassword = $uidExists["userPassword"];
  $checkPasswords = password_verify($password, $hashedPassword);

  // Checks if the passwords match the database, if false (it does not match)
  // send user back to login page with error "wrong password"
  if ($checkPasswords === false) {
    header('location: ../login.php?error=wrongPassword');
    exit();
  }
  elseif ($checkPasswords === true) {
    session_start();
    $_SESSION['userID'] = $uidExists['userID'];
    $_SESSION['userUserName'] = $uidExists['userUserName'];

    header('location: ../index.php');
    exit();
  }
}








?>
