<?php
if (!isset($_SESSION['login']))
{
	echo '
	<header>
		<h1>Innlogging</h1>
	</header>
	<form id="loginform" method="post" action="login.php">
		<p><input type="text" id="user" name="user" placeholder="Brukernavn" /><a href="#" onClick="slideToggle(\'#register\')">Ny bruker?</a></p>
   		<p><input type="password" id="pass" name="pass" placeholder="Passord" /><a href="#" onClick="slideToggle(\'#password\')">Glemt passordet?</a></p>
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
		<div id="usermenu">
			<p><a href="#" onClick="slideToggle(\'#newpost\')">Nytt innlegg</a></p>
			<p><a href="#">Administrer brukere</a></p>
		</div>';
	}
	echo '
	<form id="loginform" method="post" action="logout.php">
		<input type="submit" value="Logg ut" />
	</form>';
}
?>