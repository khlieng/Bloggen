<?php 
include('dbconn.php');

function echoPost($data, $i)
{
	echo '<article class="blogpost">';
	if (isset($_SESSION['login']))
	{
		/*echo '<section class="postOptions">
			  <a href="deletepost.php?id='.mysql_result($data, $i, 'id').'">Slett</a><a href="#" onClick="alert(\'Ikke implementert :(\')">Endre</a>
			  </section>';*/
	}
	$datetime = date('d.m.Y H:i', strtotime(mysql_result($data, $i, 'datetime')));
	echo '<header>
	<div class="comment_bubble">
		<a href="index.php?showid='.mysql_result($data, $i, 'id').'">325</a>
	</div>
	<h1><a href="javascript:void(0)" onClick="showId('.mysql_result($data, $i, 'id').')">'.mysql_result($data, $i, 'title').'</a></h1>
	<p class="date">'.$datetime.'</p>
	</header>
	<p>'.mysql_result($data, $i, 'content').'</p>
	<footer>
	<div class="floatleft">'.$datetime.' | <a href="javascript:void(0)" onClick="showId('.mysql_result($data, $i, 'id').')">0 kommentarer</a></div><div class="floatright">Tags: ';

	$tags = array_map('trim', explode(',', mysql_result($data, $i, 'tags')));
	for ($j = 0; $j < sizeof($tags); $j++)
	{
		echo '<a href="#">'.$tags[$j].'</a>';
		if ($j < sizeof($tags) - 1)
		{
			echo ' | ';
		}
	}	
	echo '</div>
	</footer>
	</article>';
}

if (isset($_GET['showid']))
{
	$data = mysql_query("SELECT * FROM posts WHERE id='".$_GET['showid']."'");
	if (mysql_numrows($data) > 0)
	{
		echoPost($data, 0);
		
		$name = utf8_encode("Ken-Håvard Lieng");
		
		echo '<article>
		<header>
			<h1>325 kommentarer</h1>
		</header>
		</article>
		<article class="comment">
			<div class="comment_image">
				<img src="http://www.damianiconcrete.com/files/5612/9744/1263/person-placeholder.jpg" width="50" height="75">
			</div>
			<div class="comment_content">
				<h2>'.$name.'</h2>
				<p class="date">25.03.2012 18:55</p>
				<p>For et flott innlegg asså :o</p>
			</div>
		</article>
		<article class="comment">
			<div class="comment_image">
				<img src="http://www.damianiconcrete.com/files/5612/9744/1263/person-placeholder.jpg" width="50" height="75">
			</div>
			<div class="comment_content">
				<h2>'.$name.'</h2>
				<p class="date">25.03.2012 18:59</p>
				<p>Joda</p>
			</div>
		</article>';
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