<?php
include('dbconn.php');

$result = mysql_query("SELECT * FROM users WHERE mail='".$_GET['email']."'");
if (mysql_num_rows($result) > 0)
{
	//echo 'Mailen er allerede i bruk.';
	echo 'false';
}
else 
{
	//echo '';
	echo 'true';
}

mysql_close();
?>