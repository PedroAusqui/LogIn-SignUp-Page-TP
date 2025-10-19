<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/SignUpStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>

  <div class="Main-Container">
    <div class="Left-Side">
      <div class="left-content">
        <img src="<?php echo BASE_URL; ?>assets/Img/Logo.png" alt="Logo" class="logo-icon"> 
        <h2>Welcome!</h2>
        <h1>Sales Management</h1>
        <p>Take control of your business <br>
        has never been easier..</p>
      </div>
    </div>

    <div class="Right-Side">
      <div class="SignUp-container">
        <h1 class="title">Create Your Account</h1>
        <p class="subtitle">Join to optimize your sales</p>

         <?php if (!empty($_SESSION['flash']['error'])): ?>
          <div class="form-alert error"><?php echo htmlspecialchars($_SESSION['flash']['error']); ?></div>
          <?php unset($_SESSION['flash']['error']); ?>
        <?php endif; ?>

        <form class="SignUp-form" method="POST">
          <div class="input-group">
            <input type="text" name="Username" placeholder="Username" id="Username" autocomplete="off" required>
          </div>
          <div class="input-group">
            <input type="email" name="email" placeholder="Example@gmail.com" id="Email" autocomplete="off" required>
          </div>
          <div class="input-group">
            <input type="date"  name="Birthdate" placeholder="Birth Date" id="Birthdate" autocomplete="off" required>
          </div>
          <div class="input-group">
            <input type="password" name="password" placeholder="Password" id="Password" autocomplete="new-password" required>
            <input type="checkbox" id="show-pass1" class="show-pass" onclick="togglePass('Password')">
            <label for="show-pass1" class="toggle-eye"></label>
          </div>
          <div class="input-group">
            <input type="password" name="ConfirmPassword" placeholder="Confirm Password" id="ConfirmPassword" autocomplete="new-password" required>
            <input type="checkbox" id="show-pass2" class="show-pass" onclick="togglePass('ConfirmPassword')">
            <label for="show-pass2" class="toggle-eye"></label>
          </div>
          <div id="password-requirements">
            <p id="length" class="invalid">Debe tener al menos 8 caracteres</p>
            <p id="uppercase" class="invalid">Debe contener una mayúscula</p>
            <p id="number" class="invalid">Debe contener un número</p>
            <p id="special" class="invalid">Debe contener un carácter especial (!@#$...)</p>
          </div>
          <div id="confirm-feedback">
            <p id="confirm-match" class="invalid">Las contraseñas deben coincidir</p>
          </div>

          <button type="submit" name="submit_SignUp" class="btn-SignUp" id="btn-submit">SIGN UP</button>
          <p class="signup">
            already have an account? <a href="<?php echo BASE_URL; ?>login">Log In</a>
          </p>
        </form>
      </div>
    </div>
  </div>

    <script src="<?php echo BASE_URL; ?>Js/Script.js"></script>

</body>
</html>