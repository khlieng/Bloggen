<?php
include('dbconn.php');

if (!isset($_SESSION['login']))
{
	echo '
	<div class="buttons clearfix">
		<button onClick="openDialog(\'#login_dialog\', function() {})">Logg inn</button>
		<button onClick="openDialog(\'#register_dialog\', function() {})">Ny bruker</button>
	</div>';
}
else 
{
	echo '
	<header>
		<h1>Brukermeny</h1>
	</header>';
	if (isset($_SESSION['admin']))
	{
		echo '<p>Logget inn som administrator.</p>
		<div id="usermenu" class="sidemenu clearfix">
			<p><a href="javascript:void(0)" onClick="openDialog(\'#newpost_dialog\', function() {})">Nytt innlegg</a></p>
			<p><a href="#">Administrer brukere</a></p>
		</div>';
	}
	else
	{
		$result = mysql_query("SELECT * FROM users WHERE id=".$_SESSION['userid']);
		$name = utf8_decode(mysql_result($result, 0, 'name'));
		echo '<p>Velkommen, '.$name.'</p>';
		
		if (isset($_SESSION['inactive']))
		{
			echo '<p>Brukeren har ikke blitt aktivert.</p>
			<div id="usermenu" class="sidemenu clearfix">
				<p><a href="javascript:void(0)" onClick="resendActivation()">Send ny aktivering</a></p>
			</div>';
		}
	}
	echo '
	<form id="logoutform" class="form1" method="post" action="logout.php">
		<input type="submit" value="Logg ut" />
	</form>';
}

mysql_close();
?>