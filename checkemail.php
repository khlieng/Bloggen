<?php
include('dbconn.php');

$result = mysql_query("SELECT * FROM users WHERE mail='".$_GET['email']."';");
if (mysql_num_rows($result) > 0)
{
	echo 'Mailen er allerede i bruk.';
}
else 
{
	echo '';
}

mysql_close();
?>