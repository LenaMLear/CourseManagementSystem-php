
<!DOCTYPE html>
<html>
<style>
body {
  background-image: url('campus.jpg');
}
</style>
<body>
<img src="logo.jpg" width="120" height="120">
<font size="5" color=white><center><h1>Welcome to University of Czech</h1></center></font >
<br>
<br><br><br><br><br>

<table border="4" align="center" bgcolor="white">
<tr>
<td>

<center><h1> Please Sign up</h1>


<form name="login" method="post" action="signup.php">

<p>User: <input type="text" name="user"></p>

<p>Password: <input type="password" name="pass"></p>

<p>Are you a/an: <input type=radio name="position" value="Student">Student
<input type=radio name="position" value="Teacher">Instructor
<input type=radio name="position" value="Employee">Employee </p>

</p>
<input type="submit" name="ss" value="Submit">
<p> Already have an account?<a href="index.php"> Login</a> </p>


</form>
</center>
</td>
</tr>
</table>
</html>