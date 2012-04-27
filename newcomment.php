<?php
session_start();
if (isset($_SESSION['login']) && !isset($_SESSION['inactive']))
{
	include('dbconn.php');

	$allowed_tags = '<a><b><br><center><embed><img><p><small><strong>';

	$postid = $_POST['postid'];
	$content = utf8_encode(strip_tags($_POST['content'], $allowed_tags));
	$datetime = date('Y-m-d H:i:s');

	mysql_query("INSERT INTO comments VALUES('','".$postid."','".$_SESSION['userid']."','".$content."','".$datetime."')");

	mysql_close();
}
?>