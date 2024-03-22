<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "college_db";
$connection = mysqli_connect("$server","$username","$password","$database");
if(!$connection)
{
	echo("connection terminated");
}
?>