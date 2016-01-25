<?php
	require_once(SERVER_ROOT . '/module/create_query/module.php');
	require_once(SERVER_ROOT . '/module/run_query/module.php');

	
	$m_axes = json_decode($_POST["m_axes"]);


	$query = create_query($m_axes);


	$data = run_query($query);



	$output = new stdClass();
	$output->query = $query;
	$output->data = $data;


	echo json_encode($output);


?>