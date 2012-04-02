<?php
include('dbconn.php');

switch ($_GET['type'])
{
	case 'post':
		mysql_query("DELETE FROM posts WHERE id=".$_GET['id']);
		break;
		
	case 'comment':
		mysql_query("DELETE FROM comments WHERE id=".$_GET['id']);
		break;
}

mysql_close();
?>