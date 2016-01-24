<?php
	require_once(SERVER_ROOT . '/module/create_query/module.php');

	
	$m_axes = json_decode($_POST["m_axes"]);


	$query = create_query($m_axes);



	// $query = 'foo';



	$output = new stdClass();
	$output->query = $query;


	echo json_encode($output);


?>