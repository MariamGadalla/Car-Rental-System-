<?php

function Connect()
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "carrentalsystem";

	//Create Connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname, 3306) or die($conn->connect_error);

	return $conn;
}
?>