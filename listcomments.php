<?php
include('dbconn.php');
session_start();

function echoComment($comment)
{
	$commenter_name = "Ukjent bruker";
	$userdata = mysql_query("SELECT name FROM users WHERE id=".$comment['userid']);
	if (mysql_num_rows($userdata) > 0)
	{
		$commenter_name = mysql_result($userdata, 0);
	}
	
	echo '
	<article class="comment" id="comment-id-'.$comment['id'].'">
		<div class="comment_image">
			<img src="http://www.damianiconcrete.com/files/5612/9744/1263/person-placeholder.jpg" width="50" height="75">
		</div>
		<div class="comment_content">
			<h2>'.$commenter_name.'</h2>
			<p class="date">25.03.2012 18:55</p>
			<p>'.utf8_decode($comment['content']).'</p>
		</div>
	</article>';
}

if (isset($_GET['postid']))
{
	$data = mysql_query("SELECT * FROM comments WHERE postid=".$_GET['postid']);
	$num_comments = mysql_num_rows($data);
	
	echo '
	<article>
		<header>
			<h1>'.$num_comments.' kommentarer</h1>
		</header>
	</article>';
	
	while ($row = mysql_fetch_assoc($data))
	{
		echoComment($row);
	}
}
mysql_close();
?>