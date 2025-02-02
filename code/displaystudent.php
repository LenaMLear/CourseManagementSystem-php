<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to University of Lebanon</title>
  <link rel="stylesheet" href="css/displaystudent.css">
</head>

<body>
  <div class="header">
    <h1 >University of Lebanon</h1>
    <?php include './component/studentMenu.php'; ?>
  </div>

  <div class="container">
    <?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
    }
    if(isset($_SESSION['user']) && $_SESSION['user'] != "") {
      require("functions.php");?>
      <div class="welcome">
        <h1>welcome user <?=htmlspecialchars($_SESSION['user'])?></h1>
      </div>
    <?php } ?>
  </div>

  <div class="box">
    <h3>To register your courses, Click here: <a href="register.php">Courses</a></h3>

    <p>Welcome to University of Lebanon. Our goal is to help students excel in their skills by providing high-quality
      education, engaging opportunities to apply knowledge in real-world scenarios, and connecting with a vibrant
      community of peers. The university bases its educational philosophy, standards, and practices on the American
      liberal arts model of higher education. The university believes deeply in and encourages freedom of thought and
      expression and seeks to foster tolerance and respect for diversity and dialogue. Graduates will be individuals
      committed to creative and critical thinking, life-long learning, personal integrity, civic responsibility, and
      leadership.</p>
    <div class="typewriter" id="txt"></div>
  </div>

</body>

</html>