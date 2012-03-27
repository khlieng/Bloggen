<?php
include("mailwrapper.php");
include("dbconn.php");

function randomPassword($length)
{
	$possibleChars = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$result = "";
	for ($i = 0; $i < $length; $i++)
	{
		$result.=$possibleChars[rand(0, strlen($possibleChars) - 1)];
	}
	return $result;
}

$newpassword = randomPassword(10);

$mail = $_POST['email'];
$result = mysql_query("SELECT id FROM users WHERE mail='".$mail."'");
$id = mysql_result($result, 0, "id");
mysql_query("UPDATE users SET password=MD5('".$newpassword."') WHERE id='".$id."'");

sendMail($_POST['email'], "Nytt passord", "Ditt nye passord er: ".$newpassword);

mysql_close();
header("location:index.php");
?>