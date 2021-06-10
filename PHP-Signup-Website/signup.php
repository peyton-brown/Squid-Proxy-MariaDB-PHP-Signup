<!-- Header -->
<?php
  include_once 'templates/header.php';
?>

  <!-- Signup Form -->
  <section class="signupForm">
    <h2>Sign Up</h2>
    <!-- signup.include - user will not see this file -->
    <form action="inc/signup-include.php" method="POST" class="signupInput">
      <input type="text" name="uid" placeholder="Username" />
      <input type="password" name="pwd" placeholder="Password" />
      <div class="signUpBottonContainer">
        <div class="center">
          <button type="submit" name="submit">Sign Up</button>
        </div>
      </div>
    </form>
    <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == 'emptyEntrie') {
          echo "<p class=\"errorMsg\">Please enter all fields.</p>";
        } elseif ($_GET['error'] == 'invalidUserName') {
          echo "<p class=\"errorMsg\">Username can only have a-z, A-Z, or 0-9.</p>";
        } elseif ($_GET['error'] == 'invalidEmail') {
          echo "<p class=\"errorMsg\">Enter a vaild email address.</p>";
        } elseif ($_GET['error'] == 'passwordMatch') {
          echo "<p class=\"errorMsg\">The password you entered does not match.</p>";
        } elseif ($_GET['error'] == 'userNameExists') {
          echo "<p class=\"errorMsg\">Username is already taken.</p>";
        } elseif ($_GET['error'] == 'successfullySignedUp'){
          echo "<p class=\"errorMsg\">Successfully Signed Up.</p>";
        }
      }
    ?>
  </section>
<!-- Footer -->
<?php
  include_once 'templates/footer.php'
?>
