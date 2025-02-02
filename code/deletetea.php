<?php
require("functions.php");

// Get the user ID from the query parameters and sanitize it
$id = intval($_GET['id']);

// Establish a database connection
$con = connect();

// Combine the two queries into one string, separated by a semicolon
$query = "DELETE FROM instructor WHERE user_id=$id; DELETE FROM users WHERE user=$id";

// Execute the combined query
if (mysqli_multi_query($con, $query)) {
    do {
        /* store first result set */
        if ($result = mysqli_store_result($con)) {
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($con));

    // Redirect to the display page after successful deletion
    header("Location: displaytea.php");
    exit();
} else {
    // Handle the error
    echo "Error: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);

