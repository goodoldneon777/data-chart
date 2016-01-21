<?php
	
	function create_sqlQuery($axes, $filter = null) {
		require (SERVER_ROOT . '/php/dist/constant.php');
		require_once(SERVER_ROOT . '/module/create_definition/module.php');
		include_once(SERVER_ROOT . '/module/create_sqlQuery/dist/create_subquery.php');



		$year = '15';



		//Y-axis stuff.
		// $y_id = '[bop_ladle_add bop_ladle_al total]';
		$y_id = '[chem a_l1 c]';
		$y_def = create_definition($y_id);
		$y_sql = $y_def->sql;

		if ($y_sql->nullToZero) {
			$y_sql->y_field = 'isNull(y, 0) as y';
		} else {
			$y_sql->y_field = 'y';
		}

		$y_sql->join_field = 
			"on $const->table.$const->field_id = subY.$const->field_id \n" .
			"and $const->table.$const->field_year = subY.$const->field_year ";
		$y_sql->join_field = indent($y_sql->join_field, 2);
		//End: Y-axis stuff.


		//X-axis stuff.
		$x_id = '[time tap]';
		$x_def = create_definition($x_id);
		$x_sql = $x_def->sql;

		if ($x_sql->nullToZero) {
			$x_sql->x_field = 'isNull(x, 0) as x';
		} else {
			$x_sql->x_field = 'x';
		}

		$x_sql->join_field = 
			"on $const->table.$const->field_id = subX.$const->field_id \n" .
			"and $const->table.$const->field_year = subX.$const->field_year ";
		$x_sql->join_field = indent($x_sql->join_field, 2);
		//End: X-axis stuff.


		// $query_y = create_subquery('[temp_diff tap ar_arrive] + [temp hm_ladle]', 'y');
		$query_y = create_subquery($y_id, $year, 'y');
		$query_y = indent($query_y, 2);

		$query_x = create_subquery($x_id, $year, 'x');
		$query_x = indent($query_x, 2);
		

		$query =
			"select $x_sql->x_field, $y_sql->y_field, $const->table.ht_num as heat \n" .
			"from $const->db.$const->table $const->table \n" .
			"$x_sql->join join ( \n" .
			"$query_x \n" .
			") subX \n" .
			"$x_sql->join_field \n" .
			"$y_sql->join join ( \n" .
			"$query_y \n" .
			") subY \n" .
			"$y_sql->join_field ";



		return $query;
	}


?>