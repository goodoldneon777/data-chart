<?php
	
	function parse_data($query_results, $round_count = null) {
		$data_heat = array();

		foreach ($query_results as $row) {
		  $data_heat[] = array("x"=>$row['x'], "y"=>$row['y'], "heat"=>$row['heat'], "tap_date"=>$row['tap_date']);
		}



		$data_round = array();

		foreach ($query_results as $key=>$row) {
			if ($row['x_round']) {
		    if (!$round_count  ||  $row['y_count'] >= $round_count) {
		    	$data_round[] = array("x"=>$row['x_round'], "y"=>$row['y_avg'], "y_stdev"=>$row['y_stdev'], "y_count"=>$row['y_count']);
		    }
			}
		}

		//This removes duplicate rows in the array. Not sure exactly how it works, but it does...
		$data_round =
			array_values(
				array_filter(
					array_unique($data_round, SORT_REGULAR)
				)
			);



		$output = new stdClass();
		$output->data_heat = $data_heat;
		$output->data_round = $data_round;

		return $output;
	}


?>