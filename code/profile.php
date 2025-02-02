<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>

<?php
session_start();
include './component/studentMenu.php'; // Assuming this file contains student menu content

if(isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
    require("functions.php");

    $connection = connect();

    if(!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to fetch student data
    $query_student = "SELECT
        student.user_id,
        student.first_name,
        student.last_name,
        student.major,
        student.year_in_school AS Year,
        student.email,
        plainPassword
    FROM
        student
    JOIN
        users ON users.user = student.user_id
    WHERE
        student.user_id = $user_id";

    $result_student = mysqli_query($connection, $query_student);

    if(!$result_student) {
        die("Query failed: " . mysqli_error($connection));
    }

    // Fetch student data
    $student_data = mysqli_fetch_assoc($result_student);

    // Query to fetch registered courses and marks
    $query_courses = "SELECT  DISTINCT
        course.course_name,
        instructor.name AS instructor_name,
        marks.mark
    FROM
        registration
    INNER JOIN
        student ON registration.student_id = student.user_id
    INNER JOIN
        course ON registration.course_id = course.course_id
    INNER JOIN
        instructor ON registration.instructor_id = instructor.user_id
    LEFT JOIN
        marks ON registration.registration_id = marks.registration_id
    WHERE
        student.user_id = $user_id";

    $result_courses = mysqli_query($connection, $query_courses);

    if(!$result_courses) {
        die("Query failed: " . mysqli_error($connection));
    }
?>

<div class="container mt-4">
    <div class="row">
        <!-- Student Information Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Student Information
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $student_data['first_name'] . ' ' . $student_data['last_name']; ?></h5>
                    <p class="card-text"><strong>Student ID:</strong> <?php echo $student_data['user_id']; ?></p>
                    <p class="card-text"><strong>Major:</strong> <?php echo $student_data['major']; ?></p>
                    <p class="card-text"><strong>Year:</strong> <?php echo $student_data['Year']; ?></p>
                    <p class="card-text"><strong>Email:</strong> <?php echo $student_data['email']; ?></p>
                    <p class="card-text"><strong>Password:</strong> <?php echo $student_data['plainPassword']; ?></p>
                </div>
            </div>
        </div>

        <!-- Registered Courses Table -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Registered Courses
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Instructor</th>
                                <th>Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row = mysqli_fetch_assoc($result_courses)) { ?>
                            <tr>
                                <td><?php echo $row['course_name']; ?></td>
                                <td><?php echo $row['instructor_name']; ?></td>
                                <td><?php echo isset($row['mark']) ? $row['mark'] : 'N/A'; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- Close row -->
</div> <!-- Close container -->

<?php
    mysqli_close($connection);
} else {
    die("Sorry, access denied, please login");
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
