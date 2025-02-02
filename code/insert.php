<html>
<head>
 <script>
  function go(){
	  confirm = confirm("Do you want really to go to display.php page?");
	  if(confirm)
		window.location="display.php";
  }
 </script>
</head>
<style>
body {
  background-image: url('campusd.jpg');
}
</style>
<center><table border=1 bgcolor=white HEIGHT=40% width=35% >
<form name="insert" method="post" action="insert.php">
<tr>
 <td>Student ID    </td>
 <td><input type="text" name="id"></td>
</tr>
<tr>
 <td>First name</td>
 <td><input type="text" name="fname"></td>
</tr>
 <td>Last name</td>
 <td><input type="text" name="lname"></td>
</tr>
 <td>Major</td>
 <td><input type="text" name="major"></td>
</tr>
</tr>
 <td>Password</td>
 <td><input type="password" name="Password"></td>
</tr>
<tr>
 <td colspan="2">
<center> <input type="submit" name="s">
 <input type="button" value="Display" onclick="go();"></center>
 </td>
</tr>
</form>
</table></center>


<?php
require("functions.php");

if(isset($_POST['s'])){
	
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$major = $_POST['major'];
$password=$_POST['Password'];

$con = connect();
$query="insert into students values('$fname','$lname','$major','$password','$id')";
$query1="insert into login values('$id','$password','student')";
$result1=mysqli_query($con, $query1);
$result=mysqli_query($con, $query);

if($result){
	echo "Insert done";
	header("Location: display.php");
}
else {
	mysqli_error();
	echo "<a href='display.php'>Go back</a>";
}


}

?>