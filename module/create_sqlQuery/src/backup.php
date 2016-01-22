<?php

	function create_subquery($id, $year, $alias = null) {
		require (SERVER_ROOT . '/php/dist/constant.php');
		require_once (SERVER_ROOT . '/php/dist/extension.php');
		require_once (SERVER_ROOT . '/module/create_definition/module.php');


		//Separate into $thisQuery and $subquery objects.


		$where_realistic_all = '';


		if (!$alias) {
			$alias = $id;
		}



		if (count(idMultiStrToArr($id)) === 1) {	//If there's only 1 field to select (i.e. no subqueries needed).
			$def = create_definition($id);

			$thisQuery = clone $def;
			$type = $def->info->type;
			$field = $def->sql->field;
			$id_arr = $def->sql->id_arr;
			$where_local = $def->sql->where_local;
			$where_realistic = $def->sql->where_realistic;

			if (count($id_arr) > 1) {
				$hasSubfield = true;
			} else {
				$hasSubfield = false;
			}
		} else {	//If there are multiple fields to select (i.e. subqueries needed).
			$hasSubfield = true;
			$field = $id;
			$id_arr = idMultiStrToArr($id);
			// $where_local = null;
		}



		if (!$hasSubfield) {	//If subqueries are NOT needed.
			$def = create_definition($id);
			$sql = $def->sql;
			$sql->from = "$sql->db.$sql->from $sql->from ";
		} else {	//If subqueries are needed.
			$from_sub = '';
			$where = "where 1 = 1 ";

			foreach ($id_arr as $key=>$value) {
				$def = create_definition($value);
				$sql = $def->sql;
				$join = $sql->join;

				$sub_id = 'sub' . ($key + 1);
				$where_realistic = $sql->where_realistic;

				if ($where_realistic) {
					if ($where_realistic_all !== '') {
						$where_realistic_all .=
							" \n" .
							"and ";
					}

					$where_realistic_all .= "( $where_realistic )";
				}

				if ($from_sub !== '') {
					$join_type = "$join join";
					$join_field = 
						"on sub1.$const->field_id = $sub_id.$const->field_id \n" .
						"and sub1.$const->field_year = $sub_id.$const->field_year ";
					$join_field = indent($join_field, 2);
				} else {
					$join_type = '';
					$join_field = '';
				}


				$subquery_obj = create_subquery($value, $year);
				$subquery = $subquery_obj->query;


				$from_sub .= 
					"$join_type ( \n" .
					indent($subquery, 1) . " \n" .
					") $sub_id \n" .
					$join_field;
			}

			$sql->from = $from_sub;
			// $sql->where_local = create_definition($id)->sql->where_local;
			$sql->where_realistic = create_definition($id)->sql->where_realistic;
		}



		if ($sql->select_distinct) {
			$select = 'select distinct';
		} else {
			$select = 'select';
		}


		$from = $sql->from;
		$db = $sql->db;
		$where_local = $sql->where_local;
		$where_realistic = $sql->where_realistic;
		// echo "$field $where_realistic <br>";

		$where = "where $const->field_year >= '$year'";

		if ($where_local) {
			$where_local =
				"and ( \n" .
				indent($where_local, 1) . " \n" .
				")";

			$where =
				$where . " \n" .
				indent($where_local, 1);
		}


		if ($where_realistic_all) {
			$where_realistic_all =
				"and ( \n" .
				indent($where_realistic_all, 1) . " \n" .
				")";

			$where =
				$where . " \n" .
				indent($where_realistic_all, 1);
		}



		$query = 
			"$select $field as $alias, $const->field_id, $const->field_year \n" .
			"from $from \n" .
			$where;


		$output = new stdClass();
		$output->query = $query;
		$output->where_realistic = $where_realistic;


		return $output;
	}

?>








