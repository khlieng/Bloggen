<?php
require_once("Mail.php");
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

// Skyv nytt passord til DB

$from = "<kenh.web@gmail.com>";
$to = "<".$_POST['email'].">";
$subject = "Nytt passord";
$body = "Ditt nye passord er: ".$newpassword;

$host = "ssl://smtp.gmail.com";
$port = "465";
$username = "kenh.web@gmail.com";
$password = "R2weWXNnpRjacTdq";

$headers = array ('From' => $from, 
	'To' => $to, 
	'Subject' => $subject);
$smtp = Mail::factory('smtp', 
	array ('host' => $host,
		'port' => $port,
		'auth' => true,
		'username' => $username,
		'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) 
{
}
else 
{
}
header("location:index.php");
?>