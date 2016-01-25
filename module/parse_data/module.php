<?php
	
	function parse_data($query_results, $round_count_min = null) {
		$data_heat = array();

		foreach ($query_results as $row) {
		  $data_heat[] = array($row['x'], $row['y'], $row['heat'], $row['tap_date']);
		}



		$data_round = array();

		foreach ($query_results as $key=>$row) {
			if ($row['x_round']) {
		    // $data_round_tmp[] = array($row['x_round'], $row['y_avg'], $row['y_stdev'], $row['y_count']);
		    $data_round[] = array($row['x_round'], $row['y_avg']);
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