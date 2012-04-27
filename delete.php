<?php
session_start();
if (isset($_SESSION['admin']))
{
	include('dbconn.php');

	switch ($_GET['type'])
	{
		case 'post':
			$data = mysql_query("SELECT * FROM tagmap WHERE postid=".$_GET['id']);
			while ($row = mysql_fetch_assoc($data))
			{
				$tagid = $row['tagid'];
				$tagdata = mysql_query("SELECT * FROM tags WHERE id=".$tagid);
				if ($tagrow = mysql_fetch_assoc($tagdata))
				{
					if ($tagrow['count'] > 1)
					{
						mysql_query("UPDATE tags SET count=count-1 WHERE id=".$tagid);
					}
					else
					{
						mysql_query("DELETE FROM tags WHERE id=".$tagid);
					}
				}
			}
			mysql_query("DELETE FROM tagmap WHERE postid=".$_GET['id']);			

			$data = mysql_query("SELECT datetime FROM posts WHERE id=".$_GET['id']);
			$row = mysql_fetch_assoc($data);

			$m = date('m', strtotime($row['datetime']));
			$y = date('Y', strtotime($row['datetime']));

			$data = mysql_query("SELECT * FROM archive WHERE month=".$m." AND year=".$y);
			if ($row = mysql_fetch_assoc($data))
			{
				if ($row['count'] > 1)
				{
					mysql_query("UPDATE archive SET count=count-1 WHERE id=".$row['id']);
				}
				else
				{
					mysql_query("DELETE FROM archive WHERE id=".$row['id']);
				}				
			}
			
			mysql_query("DELETE FROM posts WHERE id=".$_GET['id']);
			break;
			
		case 'comment':
			mysql_query("DELETE FROM comments WHERE id=".$_GET['id']);
			break;
	}
	mysql_close();
}
?>