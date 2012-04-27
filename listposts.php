<?php 
include('dbconn.php');
session_start();

function echoPost($post)
{	
	$id = utf8_decode($post['id']);
	$title = utf8_decode($post['title']);
	$datetime = date('d.m.Y H:i', strtotime($post['datetime']));
	$content = utf8_decode($post['content']);

	$tags = mysql_query("SELECT * FROM tags WHERE id IN(SELECT tagid FROM tagmap WHERE postid=".$id.")");

	$num_comments = mysql_num_rows(mysql_query("SELECT id FROM comments WHERE postid=".$id));
	$p = '';
	if ($num_comments != 1)
	{
		$p = 'er';
	}
	
	echo '
	<article class="blogpost" id="blogpost-id-'.$id.'">
		<header>
			<div class="comment_bubble">
				<a title="'.$num_comments.' kommentar'.$p.'" href="#!/vis/'.$id.'">'.$num_comments.'</a>
			</div>';
	if (isset($_SESSION['admin']))
	{
		echo '
		<div class="post_options">
			<a href="#">Rediger</a> <a href="javascript:void(0)" onClick="deletePost('.$id.')">Slett</a>
		</div>';
	}
	echo '
		<h1><a href="#!/vis/'.$id.'">'.$title.'</a></h1>
		<p class="date">'.$datetime.'</p>
	</header>
	<p>'.$content.'</p>
	<footer>';	
	if (mysql_num_rows($tags) > 0)
	{
		echo '<ul class="tags">';
		while ($tag = mysql_fetch_assoc($tags))
		{
			echo '<li><a href="#!/tag/'.$tag['url'].'">'.$tag['tag'].'</a></li>';
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
	
	if (isset($_SESSION['inactive']))
	{
		echo '
		<article id="new_comment">
			<header>
				<h1>'.utf8_encode('Du må aktivere brukeren din for å kommentere.').'</h1>
			</header>
		</article>';
	}
	else if (isset($_SESSION['login']))
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
				<h1>'.utf8_encode('<a href="javascript:void(0)" onClick="openDialog(\'#login_dialog\', function() {})" style="color: #FF0000;">Logg inn</a> eller <a href="javascript:void(0)" onClick="openDialog(\'#register_dialog\', function() {})" style="color: #FF0000;">registrer en ny bruker</a> for å kommentere!').'</h1>
			</header>
		</article>';
	}

	echo '<div id="comments"></div>';
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

	$data = NULL;	
	if (isset($_GET['search']))
	{
		$data = mysql_query("SELECT * FROM posts WHERE title LIKE '%".$_GET['search']."%' OR content LIKE '%".$_GET['search']."%' OR tags LIKE '%".$_GET['search']."%' ORDER BY datetime DESC LIMIT ".$start.", ".$num_posts);
	}
	else if (isset($_GET['tag']))
	{
		$data = mysql_query("SELECT id FROM tags WHERE url='".$_GET['tag']."'");
		if ($row = mysql_fetch_assoc($data))
		{
			$tagid = $row['id'];
			$data = mysql_query("SELECT * FROM posts WHERE id IN(SELECT postid FROM tagmap WHERE tagid=".$tagid.") ORDER BY datetime DESC LIMIT ".$start.", ".$num_posts);
		}	
	}
	else if (isset($_GET['month']))
	{
		$data = mysql_query("SELECT * FROM posts WHERE MONTH(datetime) = ".$_GET['month']." AND YEAR(datetime) = ".$_GET['year']." ORDER BY datetime DESC LIMIT ".$start.", ".$num_posts);
	}
	else
	{
		$data = mysql_query("SELECT * FROM posts ORDER BY datetime DESC LIMIT ".$start.", ".$num_posts);
	}
	
	if ($data != NULL)
	{
		while ($row = mysql_fetch_assoc($data))
		{
			echoPost($row);
		}
	}
}
mysql_close();
?>