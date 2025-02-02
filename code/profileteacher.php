<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/profileteacher.css">
</head>

<body>

    <?php include './component/teacherMenu.php'; ?>
    <?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
    }
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        require("functions.php"); // Assuming functions.php contains your connect() function

        $connection = connect(); // Establish database connection

        // Query to fetch instructor details (assuming $_SESSION['user'] holds the instructor's user_id)
        $user_id = $_SESSION['user'];
        $query_ins = "SELECT DISTINCT
                      instructor.user_id,
                      instructor.name,
                      instructor.major,
                      instructor.email,
                      plainPassword
                  FROM
                      instructor
                      JOIN users ON users.user = instructor.user_id
                  WHERE
                      instructor.user_id = $user_id";

        $result_ins = mysqli_query($connection, $query_ins);

        if (!$result_ins) {
            die("Query failed: " . mysqli_error($connection));
        }

        // Display instructor details in a table
        echo "<table>
            <tr>
                <th>Instructor ID</th>
                <th>Name</th>
                <th>Major</th>
                <th>Email</th>
                <th>Password</th>
            </tr>";

        while ($row = mysqli_fetch_assoc($result_ins)) {
            echo "<tr>
                <td>" . $row['user_id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['major'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['plainPassword'] . "</td>
              </tr>";
        }

        echo "</table>";

        // Query to fetch students registered in courses taught by the instructor
        $query_students = "SELECT DISTINCT
                           student.user_id,
                           student.first_name,
                           student.last_name,
                           student.email,
                           course.course_name
                       FROM
                           registration
                           JOIN student ON registration.student_id = student.user_id
                           JOIN course ON registration.course_id = course.course_id
                       WHERE
                           registration.instructor_id = $user_id";

        $result_students = mysqli_query($connection, $query_students);

        if (!$result_students) {
            die("Query failed: " . mysqli_error($connection));
        }

        // Display student details in a table
        echo "<table>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Course Name</th>
            </tr>";

        while ($row = mysqli_fetch_assoc($result_students)) {
            echo "<tr>
                <td>" . $row['user_id'] . "</td>
                <td>" . $row['first_name'] . "</td>
                <td>" . $row['last_name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['course_name'] . "</td>
              </tr>";
        }

        echo "</table>";
    } else {
        die("Sorry, access denied, please login");
    }

    mysqli_close($connection);
    ?>

</body>

</html>
