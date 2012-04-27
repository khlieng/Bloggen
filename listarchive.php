<?php
include('dbconn.php');

$months = array("","Januar", "Februar", "Mars", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Desember");
$data = mysql_query("SELECT * FROM archive ORDER BY month, year");

echo '<ul>';
while ($row = mysql_fetch_assoc($data))
{
	$str = $months[$row['month']]." ".$row['year'];
	echo '<li><a href="#!/arkiv/'.$row['month'].'/'.$row['year'].'">'.$str.' <span class="findstuff-count">['.$row['count'].']</span></a></li>';
}
echo '</ul>';

mysql_close();
?>