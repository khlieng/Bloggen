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
	mysql_close();
}
header("location:index.php");
?>