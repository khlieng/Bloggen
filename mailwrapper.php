<?php
require_once("Mail.php");

function sendMail($to, $subject, $body)
{
	$from = "<kenh.web@gmail.com>";
	$address_to = "<".$to.">";
	
	$host = "ssl://smtp.gmail.com";
	$port = "465";
	$username = "kenh.web@gmail.com";
	$password = "R2weWXNnpRjacTdq";
	
	$headers = array ('From' => $from, 
		'To' => $address_to, 
		'Subject' => $subject);
	$smtp = Mail::factory('smtp', 
		array ('host' => $host,
			'port' => $port,
			'auth' => true,
			'username' => $username,
			'password' => $password));
	
	$smtp->send($address_to, $headers, $body);
}
?>