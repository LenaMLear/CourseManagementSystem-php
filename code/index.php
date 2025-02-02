<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to University of Lebanon</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/index.css">

</head>
<body>
  <div class="login-form">
    <div class="logo">
      <img src="images/logo.jpg" alt="University Logo">
    </div>
    <h1>Welcome to University of Lebanon</h1>
    <?php session_start();?>
    <?php if(isset($_SESSION['message'])): ?>
        <p style="color:red;margin-bottom:5px;"><?=$_SESSION['message'];?></p>
    <?php unset($_SESSION['message']); endif; ?>
    <form name="login" method="post" action="login.php">
    <p>User <input type="number" name="user" required></p>
    <p>Password <input type="password" name="pass" required></p>
      <input type="submit" name="ss" value="Login">
    </form>
  </div>
</body>
</html>
