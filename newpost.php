<?php
session_start();
if (isset($_SESSION['admin']))
{
	include('dbconn.php');

	$title = utf8_encode($_POST['title']);
	$content = utf8_encode($_POST['content']);
	$datetime = date('Y-m-d H:i:s');
	$tags = utf8_encode($_POST['tags']);

	mysql_query("INSERT INTO posts VALUES('','".$title."','".$datetime."','".$content."','".$tags."')");

	mysql_close();
}
?>