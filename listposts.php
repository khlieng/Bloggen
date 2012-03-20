<?php 
include('dbconn.php');

function echoPost($data, $i)
{
	echo '<article>';
	if (isset($_SESSION['login']))
	{
		echo '<section class="postOptions">
			  <a href="deletepost.php?id='.mysql_result($data, $i, 'id').'">Slett</a><a href="#" onClick="alert(\'Ikke implementert :(\')">Endre</a>
			  </section>';
	}
	$datetime = date('d.m.Y H:i', strtotime(mysql_result($data, $i, 'datetime')));
	echo '<header>
	<h1>'.utf8_decode(mysql_result($data, $i, 'title')).'</h1>
	<p class="date">'.$datetime.'</p>
	</header>
	<p>'.utf8_decode(mysql_result($data, $i, 'content')).'</p>
	<footer>
	<div class="floatleft">'.$datetime.' | <a href="#">0 kommentarer</a></div><div class="floatright">Tags: ';

	$tags = array_map('trim', explode(',', utf8_decode(mysql_result($data, $i, 'tags'))));
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
	$data = mysql_query("SELECT * FROM posts WHERE id='".$_GET['showid']."';");
	if (mysql_numrows($data) > 0)
	{
		echoPost($data, 0);
	}
}
else
{
	$data = mysql_query("SELECT * FROM posts ORDER BY datetime");
	$num_posts = mysql_numrows($data);
	
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
	
	$max_entries_per_page = 5;
	
	$start_id = $num_posts - 1;
	if (isset($_GET['from']))
	{
		$start_id = $_GET['from'];
	}
	
	$end_id = $start_id - $max_entries_per_page;
	if ($end_id < -1)
	{
		$end_id = -1;
	}
	
	for ($i = $start_id; $i > $end_id; $i--)
	{	
		echoPost($data, $i);
	}
	
	$num_pages = $num_posts / $max_entries_per_page;
	
	if ($num_pages > 1)
	{
		echo '<section id="pagenav">';
		if ($start_id < $num_posts - 1)
		{
			echo '<a href="?from='.($start_id + $max_entries_per_page).'"><</a>';
		}
		else 
		{
			echo '<a><</a>';
		}
		
		for ($i = 0; $i < $num_pages; $i++)
		{
			if ($num_posts - 1 - $i * $max_entries_per_page == $start_id)
			{
				echo '<a class="current" href="?from='.($num_posts - 1 - $i * $max_entries_per_page).'">'.($i + 1).'</a>';
			}
			else 
			{
				echo '<a href="?from='.($num_posts - 1 - $i * $max_entries_per_page).'">'.($i + 1).'</a>';
			}
		}
		
		if ($end_id >= 0)
		{
			echo '<a href="?from='.($start_id - $max_entries_per_page).'">></a>';
		}
		else 
		{
			echo '<a>></a>';
		}
		echo '</section>';
	}
}
mysql_close();
?>