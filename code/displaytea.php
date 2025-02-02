<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Panel</title>
  <link rel="stylesheet" href="css/displaytea.css">
</head>

<body>
  <?php include './component/teacherMenu.php'; ?>
  

  <div class="welcome">
    <h1>Welcome Instructors!</h1>
    <p class="warning">Be cautious! You are responsible for every entry</p>
  </div>

  <div class="container">
    <!-- Instructor Table -->
    <div>
      <table>
        <caption>Instructor Table</caption>
        <tr>
          <th>Instructor ID</th>
          <th>Name</th>
          <th>Major</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
        <?php
                session_start();
                if (isset($_SESSION['user']) && $_SESSION['user'] != ""):
                    require("functions.php");
                    $connection = connect();
                    $query = "SELECT * FROM instructor";
                    $query_result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($query_result)): ?>
        <tr>
          <td><?= htmlspecialchars($row['user_id']); ?></td>
          <td><?= htmlspecialchars($row['name']); ?></td>
          <td><?= htmlspecialchars($row['major']); ?></td>
          <td><?= htmlspecialchars($row['email']); ?></td>
          <td><button onclick="_delete(<?= htmlspecialchars($row['user_id']); ?>);">Delete</button></td>
        </tr>
        <?php endwhile; ?>
        <?php else: ?>
        <tr>
          <td colspan="5" class="warning">Access denied, please login</td>
        </tr>
        <?php endif; ?>
      </table>
      <div class="buttons">
        <button onclick="window.location.href='inserttea.php';">Insert Instructor</button>
      </div>
    </div>

    <!-- Students Table -->
    <div>
      <table>
        <caption>Students Table</caption>
        <tr>
          <th>Student ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Major</th>
          <th>Year</th>
          <th>Action</th>
        </tr>
        <?php
                if (isset($_SESSION['user']) && $_SESSION['user'] != ""):
                    $query = "SELECT * FROM student";
                    $query_result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($query_result)): ?>
        <tr>
          <td><?= htmlspecialchars($row['user_id']); ?></td>
          <td><?= htmlspecialchars($row['first_name']); ?></td>
          <td><?= htmlspecialchars($row['last_name']); ?></td>
          <td><?= htmlspecialchars($row['major']); ?></td>
          <td><?= htmlspecialchars($row['year_in_school']); ?></td>
          <td><button onclick="_deleteStudent(<?= htmlspecialchars($row['user_id']); ?>);">Delete</button></td>
        </tr>
        <?php endwhile; ?>
        <?php else: ?>
        <tr>
          <td colspan="6" class="warning">Access denied, please login</td>
        </tr>
        <?php endif; ?>
      </table>
      <div class="buttons">
        <button onclick="window.location.href='insertstu.php';">Insert Student</button>
      </div>
    </div>
  </div>

  <!-- Script for deletion confirmation -->
  <script src="./js/displaytea.js"></script>
</body>

</html>
