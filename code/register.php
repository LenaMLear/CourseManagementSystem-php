<?php
session_start();
require("functions.php");

$con = connect();

// Fetch courses
$courses_result = mysqli_query($con, "SELECT DISTINCT course_id, course_name FROM course");

// Fetch all instructors and their courses
$instructors_courses_result = mysqli_query($con, "SELECT instructor.user_id, instructor.name, course.course_id
                                                 FROM instructor
                                                 JOIN course ON instructor.user_id = course.instructor_id");
$instructors_courses = [];
while ($row = mysqli_fetch_assoc($instructors_courses_result)) {
    $instructors_courses[$row['course_id']][] = ['user_id' => $row['user_id'], 'name' => $row['name']];
}

// Check if the session is for a student
$student_id = '';
if (isset($_SESSION['pos']) && $_SESSION['pos'] === 'student') {
    $student_id = $_SESSION['user']; // Assuming 'user_id' holds the student ID in the session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>
<?php
if (isset($_SESSION['pos']) && $_SESSION['pos'] === 'instructor'){
    include './component/teacherMenu.php';
}
if (isset($_SESSION['pos']) && $_SESSION['pos'] === 'student'){
    include './component/studentMenu.php';
}
?>
<a href="index.php"><img src="./images/logo.jpg" width="120" height="120"></a>
<div class="form-container">
    <form name="insert" method="post" action="register.php" onsubmit="return validateForm()">
        <table class="form-table">
            <tr>
                <td>Student ID</td>
                <td><input type="number" name="student" id="student" value="<?php echo $student_id; ?>" <?php if ($student_id) echo 'readonly'; ?>></td>
            </tr>
            <tr>
                <td>Course</td>
                <td>
                    <select name="course" id="course" onchange="updateInstructors()">
                        <option value="">Select a course</option>
                        <?php
                        if ($courses_result->num_rows > 0) {
                            while($course = mysqli_fetch_assoc($courses_result)) {
                                echo "<option value='" . $course['course_id'] . "'>" . $course['course_name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Instructor</td>
                <td>
                    <select name="instructor" id="instructor">
                        <option value="">Select an instructor</option>
                        <!-- Instructors will be populated here dynamically -->
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <center><input type="submit" name="s" value="Register"></center>
                </td>
            </tr>
        </table>
    </form>
    <div id="error-message" class="error-message"></div>
</div>

<?php
if (isset($_POST['s'])) {
    $student = $_POST['student'];
    $course = $_POST['course'];
    $instructor = $_POST['instructor'];

    if ($student != "" && $course != "" && $instructor != "") {
        // Check if the student exists
        $stmt = $con->prepare("SELECT * FROM student WHERE user_id = ?");
        $stmt->bind_param("i", $student);
        $stmt->execute();
        $student_result = $stmt->get_result();

        // Check if the instructor exists
        $stmt = $con->prepare("SELECT * FROM instructor WHERE user_id = ?");
        $stmt->bind_param("i", $instructor);
        $stmt->execute();
        $instructor_result = $stmt->get_result();

        if ($student_result->num_rows == 0) {
            echo "<div class='message'>Student not found. Please enter a valid student ID.</div>";
        } elseif ($instructor_result->num_rows == 0) {
            echo "<div class='message'>Instructor not found. Please select a valid instructor.</div>";
        } else {
            // Check if the student is already registered for this course
            $stmt = $con->prepare("SELECT * FROM registration WHERE student_id = ? AND course_id = ?");
            $stmt->bind_param("ii", $student, $course);
            $stmt->execute();
            $duplicate_result = $stmt->get_result();

            if ($duplicate_result->num_rows > 0) {
                echo "<div class='message'>Student has already registered for this course.</div>";
            } else {
                // Check if the course has fewer than 3 registrations for this instructor
                $stmt = $con->prepare("SELECT * FROM registration WHERE course_id = ? AND instructor_id = ?");
                $stmt->bind_param("ii", $course, $instructor);
                $stmt->execute();
                $q1_result = $stmt->get_result();
                $count = $q1_result->num_rows;

                if ($count < 3) {
                    // Insert into registration table with correct fields
                    $stmt = $con->prepare("INSERT INTO registration (student_id, course_id, instructor_id, registration_date) VALUES (?, ?, ?, NOW())");
                    $stmt->bind_param("iii", $student, $course, $instructor);
                    $result = $stmt->execute();

                    if ($result) {
                        echo "<div class='message'>Registration successful!</div>";
                    } else {
                        echo "<div class='message'>Registration failed. Please try again.</div>";
                    }
                } else {
                    echo "<div class='message'>Sorry, this instructor is occupied for the selected course.</div>";
                }
            }
        }
    } else {
        echo "<div class='message'>Please fill in all fields.</div>";
    }
}
?>

<script>
    var instructorsCourses = <?php echo json_encode($instructors_courses); ?>;
</script>
<script src="./js/register.js"></script>
</body>
</html>
