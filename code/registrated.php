<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Panel</title>
    <link rel="stylesheet" href="./css/registered.css">
</head>

<body>

<?php include './component/teacherMenu.php'; ?>
<?php
session_start();

if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    require("functions.php"); // Adjust this based on your file structure
    $connection = connect(); // Connect to the database

    // Handle delete request
    if (isset($_POST['delete'])) {
        $registration_id = $_POST['registration_id'];
        $delete_query = "DELETE FROM registration WHERE registration_id = ?";
        $stmt = $connection->prepare($delete_query);
        $stmt->bind_param("i", $registration_id);
        $stmt->execute();
        $stmt->close();
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }

    // Query to fetch registration details
    $query_reg = "SELECT DISTINCT
    registration.registration_id,
    student.user_id,
    student.first_name AS student_name,
    course.course_name,
    instructor.name AS instructor_name,
    registration.registration_date
    FROM
    registration
    INNER JOIN student ON registration.student_id = student.user_id
    INNER JOIN course ON registration.course_id = course.course_id
    INNER JOIN instructor ON registration.instructor_id = instructor.user_id";

    $result_reg = mysqli_query($connection, $query_reg);

    if (!$result_reg) {
        die("Query failed: " . mysqli_error($connection));
    }

    ?>

    <table>
        <caption>Registration Details</caption>
        <tr>
            <th>Student ID</th>
            <th>Student</th>
            <th>Course</th>
            <th>Instructor</th>
            <th>Registration Date</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result_reg)) : ?>
        <tr>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['student_name'] ?></td>
            <td><?= $row['course_name'] ?></td>
            <td><?= $row['instructor_name'] ?></td>
            <td><?= $row['registration_date'] ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="registration_id" value="<?= $row['registration_id'] ?>">
                    <input type="submit" name="delete" value="Delete">
                </form>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>

    <div class="button-container">
        <button onclick="window.location.href='register.php';">Insert</button>
    </div>

    <?php
} else {
// Session is not set or empty, show warning message or redirect to login
echo '<div class="warning">Access denied. Please <a href="login.php">login</a>.</div>';
}
?>

</body>

</html>
