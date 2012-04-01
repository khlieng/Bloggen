<?php
include('dbconn.php');

$type = $_GET['type'];
$id = $_GET['id'];

switch ($type)
{
	case 'post':
		mysql_query("DELETE FROM posts WHERE id='".$id."'");
		break;
		
	case 'comment':
		mysql_query("DELETE FROM comments WHERE id='".$id."'");
		break;
}

mysql_close();
?>