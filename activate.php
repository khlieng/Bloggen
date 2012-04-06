<?php
include('dbconn.php');

$id = $_GET['userid'];
$code = $_GET['code'];

$result = mysql_query("SELECT * FROM confirmation WHERE userid=".$id);
if (mysql_num_rows($result) > 0)
{
	if (mysql_result($result, 0, 'code') == $code)
	{
		mysql_query("DELETE FROM confirmation WHERE userid=".$id);
		mysql_query("UPDATE users SET status='active' WHERE id=".$id);
	}
}
mysql_close();
header('location:index.php');
?>