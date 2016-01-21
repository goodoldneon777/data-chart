<?php

	function create_subquery($id, $year, $alias = null) {
		require (SERVER_ROOT . '/php/dist/constant.php');
		require_once (SERVER_ROOT . '/php/dist/extension.php');
		require_once (SERVER_ROOT . '/module/create_definition/module.php');


		if (!$alias) {
			$alias = $id;
		}



		if (count(idMultiStrToArr($id)) === 1) {
			$def = create_definition($id);
			$type = $def->info->type;
			$field = $def->sql->field;
			$id_arr = $def->sql->id_arr;
			$where_local = $def->sql->where_local;

			if (count($id_arr) > 1) {
				$hasSubfield = true;
			} else {
				$hasSubfield = false;
			}
		} else {
			$hasSubfield = true;
			$field = $id;
			$id_arr = idMultiStrToArr($id);
			$where_local = null;
		}



		if (!$hasSubfield) {
			$def = create_definition($id);
			$sql = $def->sql;
			$sql->from = "$sql->db.$sql->from $sql->from ";
		} else {
			$from_sub = '';
			$where = "where 1 = 1 ";

			foreach ($id_arr as $key=>$value) {
				$def = create_definition($value);
				$sql = $def->sql;
				$join = $sql->join;

				$sub_id = 'sub' . ($key + 1);
				$where_realistic = create_definition($value)->sql->where_realistic;
				if ($where_realistic) {
					$where = " \n" . $where_realistic;
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

				$from_sub .= 
					"$join_type ( \n" .
					indent(create_subquery($value, $year), 1) . " \n" .
					") $sub_id \n" .
					$join_field;
			}

			$sql->from = $from_sub;
		}



		if ($sql->select_distinct) {
			$select = 'select distinct';
		} else {
			$select = 'select';
		}


		$from = $sql->from;
		$db = $sql->db;


		if ($where_local) {
			$where_local =
				"where $const->field_year >= '$year' \n" .
				indent($where_local, 1);
		} else {
			$where_local = "where $const->field_year >= '$year' ";
		}



		$query = 
			"$select $field as $alias, $const->field_id, $const->field_year \n" .
			"from $from \n" .
			$where_local;

		return $query;
	}

?>