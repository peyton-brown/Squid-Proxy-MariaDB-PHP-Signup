<?php

if (isset($_POST["submit"])) {
  // Global variables
  $userName = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);

  require_once 'db_handler-include.php';
  require_once 'functions-include.php';

  if (emptyEntrie($userName, $password) !== false) {
    header('location: ../signup.php?error=emptyEntrie');
    exit();
  }

  if (invalidUserName($userName) !== false) {
    header('location: ../signup.php?error=invalidUserName');
    exit();
  }

  if (userNameExists($conn, $userName) !== false) {
    header('location: ../signup.php?error=usernameIsTaken');
    exit();
  }

  createUser($conn, $userName, $password);
}
else {
  header('location: ../signup.php');
  exit();
}


?>
