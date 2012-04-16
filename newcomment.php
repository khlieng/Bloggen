<?php
session_start();
if (isset($_SESSION['login']) && !isset($_SESSION['inactive']))
{
	include('dbconn.php');

	$postid = $_POST['postid'];
	$content = utf8_encode($_POST['content']);
	$datetime = date('Y-m-d H:i:s');

	mysql_query("INSERT INTO comments VALUES('','".$postid."','".$_SESSION['userid']."','".$content."')");

	mysql_close();
}
?>