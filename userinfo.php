<?php
include('dbconn.php');

if (!isset($_SESSION['login']))
{
	echo '
	<header>
		<h1>Innlogging</h1>
	</header>
	<form id="loginform" method="post" action="login.php">
		<p><input type="text" id="user" name="user" placeholder="Brukernavn" /><a href="javascript:void(0)" onClick="$(\'#register\').slideToggle()">Ny bruker?</a></p>
   		<p><input type="password" id="pass" name="pass" placeholder="Passord" /><a href="javascript:void(0)" onClick="$(\'#password\').slideToggle()">Glemt passordet?</a></p>
		<input type="submit" value="Logg inn" />
	</form>';
}
else 
{
	echo '
	<header>
		<h1>Brukerinfo</h1>
	</header>';
	if (isset($_SESSION['admin']))
	{
		echo '<p>Du er logget inn som administrator.</p>
		<div id="usermenu" class="sidemenu">
			<p><a href="javascript:void(0)" onClick="$(\'#newpost\').slideToggle()">Nytt innlegg</a></p>
			<p><a href="#">Administrer brukere</a></p>
		</div>';
	}
	else
	{
		$result = mysql_query("SELECT * FROM users WHERE id=".$_SESSION['userid']);
		$name = mysql_result($result, 0, 'name');
		echo '<p>Velkommen, '.$name.'</p>';
		
		if (isset($_SESSION['inactive']))
		{
			echo '<p>Brukeren har ikke blitt aktivert.</p>
			<div id="usermenu" class="sidemenu">
				<p><a href="javascript:void(0)" onClick="resendActivation()">Send ny aktivering</a></p>
			</div>';
		}
	}
	echo '
	<form id="loginform" method="post" action="logout.php">
		<input type="submit" value="Logg ut" />
	</form>';
}

mysql_close();
?>