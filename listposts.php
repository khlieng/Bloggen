<?php 
include('dbconn.php');
session_start();

function echoPost($data, $i)
{
	$id = mysql_result($data, $i, 'id');
	$title = mysql_result($data, $i, 'title');
	$datetime = date('d.m.Y H:i', strtotime(mysql_result($data, $i, 'datetime')));
	$content = mysql_result($data, $i, 'content');
	$tags = array_map('trim', explode(',', mysql_result($data, $i, 'tags')));
	
	echo '
	<article class="blogpost" id="blogpost-id-'.$id.'">
		<header>
			<div class="comment_bubble">
				<a href="#showid-'.$id.'">325</a>
			</div>';
	if (isset($_SESSION['admin']))
	{
		echo '
		<div class="post_options">
			<a href="#">Rediger</a> <a href="javascript:void(0)" onClick="deletePost('.$id.')">Slett</a>
		</div>';
	}
	echo '
		<h1><a href="#showid-'.$id.'">'.$title.'</a></h1>
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
	$data = mysql_query("SELECT * FROM posts WHERE id='".$_GET['postid']."'");
	if (mysql_num_rows($data) > 0)
	{
		echoPost($data, 0);
	}
}
else
{
	$max_entries_per_page = 5;
	if (isset($_GET['n']))
	{
		$max_entries_per_page = $_GET['n'];
	}
	
	$start_id = 0;
	if (isset($_GET['from']))
	{
		$start_id = $_GET['from'];
	}
	
	$data = mysql_query("SELECT * FROM posts ORDER BY datetime DESC LIMIT ".$start_id.", ".$max_entries_per_page);
	$num_posts = mysql_num_rows($data);
	
	for ($i = 0; $i < $num_posts; $i++)
	{	
		echoPost($data, $i);
	}
	
	/*$blog = simplexml_load_file('blog.xml');
	$entries = array();
	foreach ($blog->entry as $entry)
	{
		if (isset($_GET['tag']))
		{
			$tags = array_map('trim', explode(',', $entry->tags));
			if (in_array($_GET['tag'], $tags))
			{
				$entries[] = $entry;	
			}
		}
		else
		{
			$entries[] = $entry;
		}		
	}*/
}
mysql_close();
?>