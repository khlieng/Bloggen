<?php
include('dbconn.php');
session_start();

$postid = $_POST['postid'];
$content = utf8_encode($_POST['content']);
$datetime = date('Y-m-d H:i:s');

mysql_query("INSERT INTO comments VALUES('','".$postid."','".$_SESSION['userid']."','".$content."')");

mysql_close();
?>