<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructors Page</title>
    <style>
        body {
            background-image: url('campus.jpg');
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        a img {
            width: 120px;
            height: 120px;
            margin-left: 10px;
            margin-top: 10px;
        }

        p {
            color: #fff;
            font-size: 30px;
            font-weight: bold;
            margin-top: 20px; /* Add space above the paragraph */
        }

        p.warning {
            color: #ff0000;
            font-size: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            text-align: center;
            width: 80%; /* Adjust width of the warning message */
            margin: 0 auto; /* Center the warning message */
            margin-bottom: 20px; /* Add space below the warning message */
        }

        .form-container {
          background-color: #fff;
          border-radius: 10px;
          padding: 20px;
          max-width: 400px;
          width: 80%;
        }

        .form-table {
            width: 100%;
            border-collapse: collapse;
        }

        .form-table td {
          padding: 10px;
          border-bottom: 1px solid #ddd;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        .form-table td:last-child {
            border-bottom: none;
        }

        table {
            border: 3px solid #fff; /* White border around the table */
            background-color: rgba(255, 255, 255); /* Semi-transparent white */
            border-spacing: 5px;
            border-collapse: separate;
            border-radius: 5px;
            width: 80%; /* Adjust the width of the table */
            max-width: 800px; /* Limit the maximum width */
            margin: 20px auto; /* Center the table */
        }

        th, td {
            padding: 5px;
            text-align: center;
            color: #000; /* Black color for table text */
        }



        td a {
            color: #00f; /* Blue color for links */
            text-decoration: none; /* Remove underline */
        }

        td a:hover {
            color: #4CAF50; /* Darker blue color on hover */
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
            border: none;
            background-color: #4CAF50;
            color: white; /* White font color */
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<a href="index.php"><img src="logo.jpg" width="50" height="50"></a>
<center><p>Welcome Instructors!</p></center>
<center><p class="warning">Be cautious! You are responsible for every entry</p></center>

<script>
    function _delete(id){
        confirm = confirm("Confirm the deletion?");
        if(confirm){
            alert("Row with id " + id + " will be deleted");
            window.location="delete.php?id="+id;
        }
    }
</script>

<?php
session_start();
if((@$_SESSION['user'] != "")){
    require("functions.php");

    $connection = connect();
    $query = "select * from students";
    $query_result = mysqli_query($connection, $query);

    echo "
    <center>
      <table>
        <tr>
          <th>Student ID</th>
          <th>First name</th>
          <th>Last name</th>
          <th>Major</th>
          <th>Password</th>
          <th>Delete</th>
        </tr>
    ";

    while($row = mysqli_fetch_assoc($query_result)){
        echo "<tr>
              <td>".$row['id']."</td>
              <td>".$row['firstName']."</td>
              <td>".$row['lastName']."</td>
              <td>".$row['major']."</td>
              <td>".$row['Password']."</td>
              <td><a href='#' onclick='_delete(".$row['id'].");'>Delete this row</a></td>
            </tr>";
    }

    echo "</table></center>";
    ?>
    <br><center>
        <button onclick="window.location.href='insertstu.php';">INSERT</button><br>
        <button onclick="window.location.href='logout.php';">LOGOUT</button>
    </center>
    <?php
} else {
    die("Sorry, access denied, please login");
}
?>
</body>
</html>
