<?php
	require_once(SERVER_ROOT . '/module/query_create/module.php');
	require_once(SERVER_ROOT . '/module/run_query/module.php');
	require_once(SERVER_ROOT . '/module/parse_data/module.php');

	
	$m_axes = json_decode($_POST["m_axes"]);


	$query = queryCreate($m_axes);


	$query_results = run_query($query);


	// $round_count_min = $m_axes->x_axis->round_count_min;
	$round_count = $m_axes->x_axis->round_count;
	$data = parse_data($query_results, $round_count);



	$output = new stdClass();
	$output->query = $query;
	$output->data_heat = $data->data_heat;
	$output->data_round = $data->data_round;
	$output->x_datatype = 'linear';


	echo json_encode($output);


?>