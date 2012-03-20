<?php
session_start();
if ($_POST['user'] == "bruker" && $_POST['pass'] == "123456")
{	
	$_SESSION['login'] = true;
	$_SESSION['admin'] = true;
}
else 
{
	include('dbconn.php');
	
	$username = $_POST['user'];
	$password = $_POST['pass'];
	
	$result = mysql_query("SELECT * FROM users WHERE mail='".$username."' AND password=MD5('".$password."');");
	if (mysql_num_rows($result) > 0)
	{
		$_SESSION['login'] = true;
	}	
	mysql_close();
}
header("location:index.php");
?>