<?php 
include('dbconn.php');
session_start();

function echoPost($post)
{	
	$id = $post['id'];
	$title = $post['title'];
	$datetime = date('d.m.Y H:i', strtotime($post['datetime']));
	$content = $post['content'];
	$tags = array_map('trim', explode(',', $post['tags']));
	
	echo '
	<article class="blogpost" id="blogpost-id-'.$id.'">
		<header>
			<div class="comment_bubble">
				<a href="#vis/'.$id.'">325</a>
			</div>';
	if (isset($_SESSION['admin']))
	{
		echo '
		<div class="post_options">
			<a href="#">Rediger</a> <a href="javascript:void(0)" onClick="deletePost('.$id.')">Slett</a>
		</div>';
	}
	echo '
		<h1><a href="#vis/'.$id.'">'.$title.'</a></h1>
		<p class="date">'.$datetime.'</p>
	</header>
	<p>'.$content.'</p>
	<footer>';	
	if (sizeof($tags) > 0 && $tags[0] != '')
	{
		echo '<ul class="tags">';		
		for ($j = 0; $j < sizeof($tags); $j++)
		{
			echo '<li><a href="#">'.$tags[$j].'</a></li>';
		}	
		echo '</ul>';
	}	
	echo '</footer>
	</article>';
}

if (isset($_GET['postid']))
{
	$data = mysql_query("SELECT * FROM posts WHERE id=".$_GET['postid']);
	if ($row = mysql_fetch_assoc($data))
	{
		echoPost($row);
	}
	
	echo '<div id="comments"></div>';
	
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
			$.post("newcomment.php", { "postid": '.$_GET['postid'].', "content": $(\'#commentform textarea[name="content"]\').val() });
			document.forms["commentform"].reset();
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
else
{
	$num_posts = 5;
	if (isset($_GET['n']))
	{
		$num_posts = $_GET['n'];
	}
	
	$start = 0;
	if (isset($_GET['from']))
	{
		$start = $_GET['from'];
	}
	
	$data = mysql_query("SELECT * FROM posts ORDER BY datetime DESC LIMIT ".$start.", ".$num_posts);
	
	while ($row = mysql_fetch_assoc($data))
	{
		echoPost($row);
	}
}
mysql_close();
?>