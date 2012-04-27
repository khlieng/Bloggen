<?php
include('dbconn.php');
include('mailwrapper.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pass'];

$result = mysql_query("SELECT * FROM users WHERE mail='".$email."'");
if (mysql_num_rows($result) < 1)
{
	mysql_query("INSERT INTO users VALUES('','".$name."','".$email."',MD5('".$password."'),'inactive')");
	
	$id = mysql_insert_id();
	$code = rand(0, 1234567890);
	mysql_query("INSERT INTO confirmation VALUES('".$id."','".$code."')");
	$url = "http://gruppe2.dyndns.org/activate.php?userid=".$id."&code=".$code;
	sendMail($email, 'Aktivering av brukerkonto', $url);
}
mysql_close();
header("location:index.php");
?>