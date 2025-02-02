<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student Change Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/profileteacher.css">
</head>

<body>

    <?php 
    if(isset($_SESSION['pos'])){
        if($_SESSION['pos'] == "instructor"){
            include './component/teacherMenu.php';
        }
        else{
            include './component/studentMenu.php';
        }
    }
    ?>   

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" name="oldy" required>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="newy" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirm"
                                    required>
                            </div>
                            <button type="submit" name="update" class="btn btn-success btn-block">Update
                                Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
if(isset($_POST['update'])){
    $oldy = $_POST['oldy'];
    $newy = $_POST['newy'];
    $confirm = $_POST['confirm'];

    $user_id = $_SESSION['user'];
    require("functions.php");
    $connection = connect();

    if(!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to fetch current password
    $query = "SELECT plainPassword FROM users WHERE user = '$user_id'";
    $query_result = mysqli_query($connection, $query);

    if(!$query_result) {
        die("Query failed: " . mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($query_result);
    $currentPassword = $row['plainPassword'];

    // Validate current password
    if($oldy != $currentPassword) {
        echo "<script>alert('Current password is incorrect');</script>";
    } else {
        // Validate new password and confirm password
        if($newy != $confirm) {
            echo "<script>alert('New password and confirm password do not match');</script>";
        } else {

            // Update password
            $hashed_password = password_hash($newy, PASSWORD_BCRYPT);
            $update_query = "UPDATE users SET plainPassword = '$newy' , pass = '$hashed_password' WHERE user = '$user_id'";
            $update_result = mysqli_query($connection, $update_query);

            if($update_result) {
                echo "<script>alert('Password updated successfully');</script>";
            } else {
                echo "<script>alert('Failed to update password');</script>";
            }
        }
    }

    mysqli_close($connection);
}
?>