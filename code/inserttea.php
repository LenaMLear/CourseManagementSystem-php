<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/inserttea.css">
    <script src="./js/inserttea.js"></script>
</head>
<body>
<?php include './component/teacherMenu.php'; ?>
<div class="form-container">
    <table class="form-table">
        <form name="insert" method="post" action="inserttea.php" onsubmit="return validateForm()">
            <tr>
                <td>Instructor ID</td>
                <td><input type="text" name="id" required></td>
            </tr>
            <tr>
                <td>Instructor Name</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td>Major</td>
                <td><input type="text" name="major" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email"></td>
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
    <div id="error-message" class="error-message"></div>
</div>

<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location:index.php');
}
require("functions.php");
if (isset($_POST['s'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $major = $_POST['major'];
    $email = $_POST['email'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $con = connect();
    $query = "INSERT INTO instructor (user_id, name, major, email) VALUES ('$id', '$name', '$major', '$email')";
    $query1 = "INSERT INTO users (user, pass, position,plainPassword) VALUES ('$id', '$hashed_password', 'instructor','$password')";
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
