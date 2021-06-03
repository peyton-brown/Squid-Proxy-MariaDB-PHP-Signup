<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PHP/MySQL Login DB</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>
    <header>
      <nav>
        <div class="wrapper">
          <ul>
            <?php
              if (isset($_SESSION['userUserName'])) {
                //echo "<li><a href=\"signup.php\">Sign Up</a></li>";
                echo "<li><a href=\"inc/logout-include.php\">Logout</a></li>";
              } else {
                echo "<li><a href=\"signup.php\">Sign Up</a></li>";
              }
            ?>
            <li>
              <a href="index.php">Home</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="wrapper">
