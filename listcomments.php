<?php
include('dbconn.php');
session_start();

function echoComment($data, $i)
{
	$userdata = mysql_query("SELECT name FROM users WHERE id='".mysql_result($data, $i, 'userid')."'");
	$name = "Ukjent bruker";
	if (mysql_num_rows($userdata) > 0)
	{
		$name = mysql_result($userdata, 0, 'name');
	}
	
	echo '
	<article class="comment">
		<div class="comment_image">
			<img src="http://www.damianiconcrete.com/files/5612/9744/1263/person-placeholder.jpg" width="50" height="75">
		</div>
		<div class="comment_content">
			<h2>'.$name.'</h2>
			<p class="date">25.03.2012 18:55</p>
			<p>'.utf8_decode(mysql_result($data, $i, 'content')).'</p>
		</div>
	</article>';
}

if (isset($_GET['postid']))
{
	$comments = mysql_query("SELECT * FROM comments WHERE postid='".$_GET['postid']."'");
	$num_comments = mysql_num_rows($comments);
	
	echo '
	<article>
		<header>
			<h1>'.$num_comments.' kommentarer</h1>
		</header>
	</article>';
	
	if ($num_comments > 0)
	{
		for ($i = 0; $i < $num_comments; $i++)
		{
			echoComment($comments, $i);
		}
	}
	
	if (isset($_SESSION['login']))
	{
		echo '
		<article id="new_comment">
			<header>
				<h1>Legg igjen en kommentar</h1>
			</header>
			<form id="commentform" name="commentform">
				<p>
					<textarea name="content"></textarea>
				</p>
	   			<p>
					<input type="submit" value="OK" />
				</p>
			</form>					
		</article>
		<script type="text/javascript">
		$("#commentform").submit(function() {
			$.post("newcomment.php", { "postid": '.$_GET['postid'].', "content" : $(\'#commentform textarea[name="content"]\').val() });
			return false;
		});
		</script>';
	}
	else 
	{
		echo '
		<article id="new_comment">
			<header>
				<h1>'.utf8_encode('Du må være logget inn for å kommentere').'</h1>
			</header>
		</article>';
	}
}
mysql_close();
?>