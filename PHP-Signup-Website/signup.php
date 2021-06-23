<!-- Header -->
<?php
  include_once 'templates/header.php';
?>

  <!-- Signup Form -->
  <section class="signupForm">
    <h2>Sign Up</h2>
    <!-- signup.include - user will not see this file -->
    <form action="inc/signup-include.php" method="POST" class="signupInput">
      <input type="text" name="uid" placeholder="Username">
      <input type="password" name="pwd" placeholder="Password">
      <br />
      <div class="signUpBottonContainer">
        <div class="center">
          <button type="submit" name="submit">Sign Up</button>
        </div>
      </div>
    </form>
  </section>

<!-- Footer -->
<?php
  include_once 'templates/footer.php'
?>
