<?php

	$server = getenv('server');
	$userWR = getenv('userRO');
	$passWR = getenv('passRO');
	$db = getenv('db');


	// Create connection
	$conn = new mysqli($server, $userWR, $passWR, $db);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 

?>