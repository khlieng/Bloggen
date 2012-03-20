<?php
include('dbconn.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pass'];

$result = mysql_query("SELECT * FROM users WHERE mail='".$email."';");
if (mysql_num_rows($result) < 1)
{
	mysql_query("INSERT INTO users VALUES('','".$name."','".$email."',MD5('".$password."'));");
}
mysql_close();
header("location:index.php");
?>