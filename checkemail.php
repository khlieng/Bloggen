<?php
include('dbconn.php');

$result = mysql_query("SELECT COUNT(0) FROM users WHERE mail='".$_GET['email']."'");
if (mysql_result($result, 0) > 0)
{
	// I bruk
	echo 'false';
}
else 
{
	// Ledig
	echo 'true';
}
mysql_close();
?>