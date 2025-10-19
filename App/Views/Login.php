<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/LogInStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo BASE_URL; ?>Js/Script.js"></script>

</head>
<body>

  <div class="Main-Container">
    <div class="Left-Side">
  <div class="left-content">
    <img src="<?php echo BASE_URL; ?>assets/Img/Logo.png" alt="Logo" class="logo-icon"> 

    <h2>Hello!</h2>
    <h1>Sales Management</h1>

    <p>The easiest way to<br>
    stay on top of your sales.</p>
  </div>
  </div>
    <div class="Right-Side">
      <div class="login-container">
        <h1 class="title">Welcome</h1>
        <p class="subtitle">Login in to your account to continue</p>

        <?php if (!empty($_SESSION['flash']['error'])): ?>
          <div class="form-alert error"><?php echo htmlspecialchars($_SESSION['flash']['error']); ?></div>
          <?php unset($_SESSION['flash']['error']); ?>
        <?php endif; ?>

        <form class="login-form" method="POST">

          <div class="input-group">
            <input type="Username" name="Username"  placeholder="Username" id="Username" autocomplete="off" required>
          </div>

          <div class="input-group">
            <input type="password" name="password"  placeholder="Password" id="password" autocomplete="new-password" required>
            <input type="checkbox" id="show-pass" class="show-pass" onclick="togglePass('password')">
            <label for="show-pass" class="toggle-eye"></label>
          </div>

          <div class="options">
            <a href="#">Forgot your password? <span>Click Here</span></a>
          </div>

          <button type="submit" name="submit_Login" class="btn-login">Login Now</button>

          <p class="signup">
            Don’t have an account? <a href="<?php echo BASE_URL; ?>signup">Sign up</a>
          </p>

        </form>
      </div>
    </div>
  </div>

</body>
</html>