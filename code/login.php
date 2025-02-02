<?php
session_start();
if(isset($_POST['ss']))
{
    require("functions.php");
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $connection = connect();

    // Use prepared statements to prevent SQL injection
    $query = $connection->prepare("SELECT * FROM users WHERE user=?");
    $query->bind_param("s", $user);
    $query->execute();
    $query_result = $query->get_result();

    if($query_result->num_rows == 1){
        $row = $query_result->fetch_assoc();
        
        // Verify the password
        if (password_verify($pass, $row['pass'])) {
            $_SESSION['user'] = $user;
            if($row['position'] == 'instructor'){
                $_SESSION['pos'] = "instructor";
                header("Location: displaytea.php");
            } else if($row['position'] == 'student'){
                $_SESSION['pos'] = "student";
                header("Location: displaystudent.php");
            }
        } else {
            $_SESSION['message'] = "Please enter valid credentials";
            header("Location: index.php");
        }
    } else {
        $_SESSION['message'] = "Please enter valid credentials";
        header("Location: index.php");
    }
}
