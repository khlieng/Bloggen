<?php
include('..\dbconn.php');
header("Content-Type: application/rss+xml; charset=UTF-8");

$data = mysql_query("SELECT * FROM posts ORDER BY datetime DESC LIMIT 0, 10");

echo '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
	<channel>
        <title>Ken-Håvard\'s Blogg</title>
        <description>10 siste blogginnlegg</description>
        <link>http://gruppe2.dyndns.org/herp/</link>
        <lastBuildDate>Mon, 06 Sep 2010 00:01:00 +0000</lastBuildDate>
        <pubDate>Mon, 06 Sep 2009 16:45:00 +0000</pubDate>
        <ttl>1800</ttl>';
while ($row = mysql_fetch_assoc($data))
{
	echo '	<item>
                <title>'.$row['title'].'</title>
                <description>'.$row['content'].'</description>
                <link>http://gruppe2.dyndns.org/herp/#vis/'.$row['id'].'</link>
                <pubDate>'.$row['datetime'].'</pubDate>
	        </item>';
}
echo '</channel>
</rss>';
?>