<?php
function connect(){
	$con = mysqli_connect("localhost", "root", "Your-Password", "lebaneseuniversity");
	return $con;
}
