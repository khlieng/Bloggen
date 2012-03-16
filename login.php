<?php
if ($_POST['user'] == "bruker" && $_POST['pass'] == "123456")
{
	session_start();
	$_SESSION['login'] = true;
}
header("location:index.php");
?>