<?php
session_start();
if (isset($_SESSION['admin']))
{
	include('dbconn.php');

	$allowed_tags = '<a><b><br><center><embed><img><p><small><strong>';

	$title = utf8_encode(strip_tags($_POST['title']));
	$content = utf8_encode(strip_tags($_POST['content'], $allowed_tags));
	$datetime = date('Y-m-d H:i:s');
	$tags = utf8_encode(strip_tags($_POST['tags']));

	mysql_query("INSERT INTO posts VALUES('','".$title."','".$datetime."','".$content."','".$tags."')");

	$postid = mysql_insert_id();
	$tags = array_map('trim', explode(',', $tags));

	for ($i = 0; $i < sizeof($tags); $i++)
	{
		$data = mysql_query("SELECT id FROM tags WHERE tag = '".$tags[$i]."'");
		$tagid = -1;
		if ($row = mysql_fetch_assoc($data))
		{
			$tagid = $row['id'];
			mysql_query("UPDATE tags SET count=count+1 WHERE id=".$tagid);
		}
		else
		{
			$url = strtolower(str_replace(' ', '-', $tags[$i]));
			mysql_query("INSERT INTO tags VALUES('','".$tags[$i]."','".$url."',1)");
			$tagid = mysql_insert_id();
		}
		mysql_query("INSERT INTO tagmap VALUES('',".$postid.",".$tagid.")");

		$m = date('m');
		$y = date('Y');
		$data = mysql_query("SELECT id FROM archive WHERE month=".$m." AND year=".$y);
		if ($row = mysql_fetch_assoc($data))
		{
			mysql_query("UPDATE archive SET count=count+1 WHERE id=".$row['id']);
		}
		else
		{
			mysql_query("INSERT INTO archive VALUES('',".$m.",".$y.",1)");
		}		
	}

	mysql_close();
}
?>