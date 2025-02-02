<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Student</title>
    <link rel="stylesheet" href="./css/insertstu.css">
</head>
<body>
<?php include './component/teacherMenu.php'; ?>

<div class="form-container">
    <table class="form-table" border="0">
        <form name="insert" method="post" action="insertstu.php" onsubmit="return validateForm()">
            <tr>
                <td>Student ID</td>
                <td><input type="text" name="id" required></td>
            </tr>
            <tr>
                <td>First name</td>
                <td><input type="text" name="fname" required></td>
            </tr>
            <tr>
                <td>Last name</td>
                <td><input type="text" name="lname" required></td>
            </tr>
            <tr>
                <td>Major</td>
                <td><input type="text" name="major" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="Password" required></td>
            </tr>
            <tr>
                <td>Year</td>
                <td><input type="text" name="year_in_school" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td>
                    <div class="buttons">
                        <input type="submit" name="s" value="Insert" class="insert-btn">
                        <input type="button" value="Display " onclick="go();" class="display-btn">
                    </div>
                </td>
            </tr>
        </form>
    </table>
    <p class="warning" id="warning">Please fill in all fields correctly</p>
</div>

<script src="./js/insertstu.js"></script>
</body>
</html>

<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location:index.php');
}
require("functions.php");
if (isset($_POST['s'])) {

    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $major = $_POST['major'];
    $password = $_POST['Password'];
    $year_in_school = $_POST['year_in_school'];
    $email = $_POST['email'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $con = connect();
    $query = "INSERT INTO student (user_id, first_name, last_name, major, year_in_school, email) VALUES ('$id', '$fname', '$lname', '$major', '$year_in_school', '$email')";
    $query1 = "INSERT INTO users (user, pass, position,plainPassword) VALUES ('$id', '$hashed_password', 'student','$password')";
    $result1 = mysqli_query($con, $query1);
    $result = mysqli_query($con, $query);

    if ($result && $result1) {
        exit();
    } else {
        echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
    }
}

?>
</body>
</html>
