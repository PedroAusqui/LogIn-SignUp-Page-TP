<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/SignUpStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo BASE_URL; ?>Js/Script.js"></script>

</head>
<body>

  <div class="Main-Container">
    <div class="Left-Side">
  <div class="left-content">
    <img src="../assets/Img/Logo.png" alt="Logo" class="logo-icon"> 

    <h2>Welcome!</h2>
    <h1>Sales Management</h1>


    <p>Take control of your business <br>
    has never been easier..</p>
  </div>
</div>

    <div class="Right-Side">
      <div class="login-container">
        <h1 class="title">Create Your Account</h1>
        <p class="subtitle">Join to optimize your sales</p>

        <form class="login-form">

        <div class="input-group">
        <input type="text" placeholder="Username" id="Username" required>
        </div>  

        <div class="input-group">
        <input type="email" placeholder="Example@gmail.com" id="Email" required>
        </div>  

        <div class="input-group">
        <input type="date" placeholder="Birth Date" id="Birthdate" required>
        </div>

          <div class="input-group">
            <input type="password" placeholder="Password" id="Password" required>
            <input type="checkbox" id="show-pass1" class="show-pass" onclick="togglePass('Password')">
            <label for="show-pass1" class="toggle-eye"></label>
          </div>

          <div class="input-group">
            <input type="password" placeholder="Confirm Password" id="ConfirmPassword" required>
            <input type="checkbox" id="show-pass2" class="show-pass" onclick="togglePass('ConfirmPassword')">
            <label for="show-pass2" class="toggle-eye"></label>
          </div>

          <button type="submit" class="btn-login">SIGN UP</button>

          <p class="signup">
            already have an account? <a href="<?php echo BASE_URL; ?>login">Log In</a>
          </p>

        </form>
      </div>
    </div>
  </div>

</body>
</html>