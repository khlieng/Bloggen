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
		<!--<div class="comment_image">
			<img src="http://www.damianiconcrete.com/files/5612/9744/1263/person-placeholder.jpg" width="50" height="75">
		</div>-->
		<div class="comment_content">';
	if (isset($_SESSION['admin']))
	{
		echo '
		<div class="post_options">
			<a href="javascript:void(0)" onClick="deleteComment('.$comment['id'].')">Slett</a>
		</div>';
	}	
	echo '<h2>'.$commenter_name.'</h2>
			<p class="date">'.date('d.m.Y H:i', strtotime($comment['datetime'])).'</p>
			<p>'.utf8_decode($comment['content']).'</p>
		</div>
	</article>';
}

if (isset($_GET['postid']))
{
	$data = mysql_query("SELECT * FROM comments WHERE postid=".$_GET['postid']." ORDER BY datetime DESC");
	$num_comments = mysql_num_rows($data);
	
	if ($num_comments > 0)
	{
		$er = "";
		if ($num_comments > 1)
		{
			$er = "er";
		}
		echo '
		<article>
			<header>
				<h1>'.$num_comments.' kommentar'.$er.'</h1>
			</header>
		</article>';
		
		while ($row = mysql_fetch_assoc($data))
		{
			echoComment($row);
		}
	}
}
mysql_close();
?>