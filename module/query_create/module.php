<?php
	
	function queryCreate($m_axes, $filter = null) {
		require (SERVER_ROOT . '/php/dist/constant.php');
		require (SERVER_ROOT . '/php/dist/extension.php');
		require (SERVER_ROOT . '/module/definition/module.php');
		require (SERVER_ROOT . '/module/query_create/dist/create_subquery.php');



		$y_axis = $m_axes->y_axis;
		$x_axis = $m_axes->x_axis;
		$filter_main = $m_axes->filter_main;


		$year_min = $filter_main->year_min;



		//Y-axis stuff.
		$y_id = paramToId($y_axis->param);
		$y_def = definitionCreate($y_id, $year_min);
		$y_sql = $y_def->sql;
		$y_min = $y_axis->min;
		$y_max = $y_axis->max;

		if ($y_sql->nullToZero) {
			$y_sql->y_field = 'isNull(y, 0) as y';
		} else {
			$y_sql->y_field = 'y';
		}

		$y_sql->join_field = 
			"on $const->table.$const->field_heat = subY.$const->field_heat \n" .
			"and $const->table.$const->field_year = subY.$const->field_year ";
		$y_sql->join_field = indent($y_sql->join_field, 2);


		$subquery = create_subquery($y_id, $year_min, 'y');
		$query_y = $subquery->query;
		$where_realistic_y = $subquery->where_realistic;
		$query_y = indent($query_y, 2);
		//End: Y-axis stuff.



		//X-axis stuff.
		$x_id = paramToId($x_axis->param);
		$x_def = definitionCreate($x_id, $year_min);
		$x_sql = $x_def->sql;
		$x_min = $x_axis->min;
		$x_max = $x_axis->max;

		if ($x_sql->nullToZero) {
			$x_sql->x_field = 'isNull(x, 0) as x';
		} else {
			$x_sql->x_field = 'x';
		}

		$x_sql->join_field = 
			"on $const->table.$const->field_heat = subX.$const->field_heat \n" .
			"and $const->table.$const->field_year = subX.$const->field_year ";
		$x_sql->join_field = indent($x_sql->join_field, 2);


		$subquery = create_subquery($x_id, $year_min, 'x');
		$query_x = $subquery->query;
		$where_realistic_x = $subquery->where_realistic;
		$query_x = indent($query_x, 2);
		//End: X-axis stuff.



		//Main filter stuff.
		$date_min = $filter_main->date_min;
		$date_max = $filter_main->date_max;
		$tap_grade = $filter_main->tap_grade;
		//End: Main filter stuff.



		//Main where clause.
		$where = "where $const->table.$const->field_year = '$year_min'";

		if ($date_min  ||  $date_max) {
			if (!$date_max) {
				$where .=
					" \n" .
					"  and $const->table.$const->field_tapDate >= '$date_min'";
			} else if (!$date_min) {
				$where .=
					" \n" .
					"  and $const->table.$const->field_tapDate <= '$date_max 23:59:59'";
			} else {
				$where .=
					" \n" .
					"  and $const->table.$const->field_tapDate between '$date_min' and '$date_max 23:59:59'";
			}
		}


		if ($tap_grade) {
			$where .=
				" \n" .
				"  and $const->table.$const->field_tapGrade like '$tap_grade'";
		}


		if ($y_min  ||  $y_max) {
			if (!$y_max) {
				$where .=
					" \n" .
					"  and y >= $y_min";
			} else if (!$y_min) {
				$where .=
					" \n" .
					"  and y <= $y_max";
			} else {
				$where .=
					" \n" .
					"  and y between $y_min and $y_max";
			}
		}


		if ($x_min  ||  $x_max) {
			if (!$x_max) {
				$where .=
					" \n" .
					"  and x >= $x_min";
			} else if (!$x_min) {
				$where .=
					" \n" .
					"  and x <= $x_max";
			} else {
				$where .=
					" \n" .
					"  and x between $x_min and $x_max";
			}
		}


		if ($where_realistic_y) {
			$where_realistic_y =
				"and ( \n" .
				indent($where_realistic_y, 1) . " \n" .
				")";

			$where =
				$where . " \n" .
				indent($where_realistic_y, 1);
		}


		if ($where_realistic_x) {
			$where_realistic_x =
				"and ( \n" .
				indent($where_realistic_x, 1) . " \n" .
				")";

			$where =
				$where . " \n" .
				indent($where_realistic_x, 1);
		}


		$where = str_replace($y_id, 'y', $where);
		$where = str_replace($x_id, 'x', $where);
		//End: Main where clause.
		


		//Main subquery.
		$round_factor = $x_axis->round_factor;

		if ($round_factor) {
			$x_field_round = "$round_factor * round(x / $round_factor, 0) as x_round";
		} else {
			$x_field_round = "null as x_round";
		}

		$query =
			"select $x_sql->x_field, $y_sql->y_field, $const->table.$const->field_heat as heat, $const->table.$const->field_tapDate as tap_date, $x_field_round \n" .
			"from $const->db.$const->table $const->table \n" .
			"$x_sql->join join ( \n" .
			"$query_x \n" .
			") subX \n" .
			"$x_sql->join_field \n" .
			"$y_sql->join join ( \n" .
			"$query_y \n" .
			") subY \n" .
			"$y_sql->join_field \n" .
			$where;
		//End: Main subquery.
		


		//Main query.
		$round_factor = $x_axis->round_factor;

		if ($round_factor) {
			$y_field_avg = "avg(y) over(partition by x_round) as y_avg";
			$y_field_stdev = "stdev(y) over(partition by x_round) as y_stdev";
			$y_field_count = "count(y) over(partition by x_round) as y_count";
		} else {
			$y_field_avg = "null as y_avg";
			$y_field_stdev = "null as y_stdev";
			$y_field_count = "null as y_count";
		}

		$query =
			"select x, y, heat, tap_date, x_round, $y_field_avg, $y_field_stdev, $y_field_count \n" .
			"from ( \n" .
			indent($query, 2) . " \n" .
			") sub";
		//End: Main query.



		return $query;
	}


?>