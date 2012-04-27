<?php
session_start();
if (isset($_SESSION['login']))
{
	include('dbconn.php');
	include('mailwrapper.php');

	$id = $_SESSION['userid'];
	$email = mysql_result(mysql_query("SELECT mail FROM users WHERE id=".$id), 0);
	$code = mysql_result(mysql_query("SELECT code FROM confirmation WHERE userid=".$id), 0);
	
	$url = "http://gruppe2.dyndns.org/activate.php?userid=".$id."&code=".$code;
	sendMail($email, 'Aktivering av brukerkonto', $url);
	
	mysql_close();
}
?>