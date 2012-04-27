<?php
include('dbconn.php');

$data = mysql_query("SELECT * FROM tags ORDER BY tag");

echo '<ul>';
while ($row = mysql_fetch_assoc($data))
{
	echo '<li><a href="#!/tag/'.$row['url'].'">'.$row['tag'].' <span class="findstuff-count">['.$row['count'].']</span></a></li>';
}
echo '</ul>';

mysql_close();
?>