<?php
	/*
	This is a recursive function that generates a query and any queries that it depends on.

	*/


	function create_subquery($id, $year, $alias = null) {
		require (SERVER_ROOT . '/php/dist/constant.php');
		require_once (SERVER_ROOT . '/php/dist/extension.php');
		require_once (SERVER_ROOT . '/module/create_definition/module.php');


		//Initialize.
		$where_realistic_all = '';

		if (!$alias) {
			$alias = $id;
		}
		//End: Initialize.



		//Test whether subqueries are needed ($hasSubfield).
		if (count(idMultiStrToArr($id)) === 1) {	//If there's only 1 field to select (i.e. no subqueries needed).
			$def_obj = create_definition($id, $year);

			$thisQuery_obj = clone $def_obj;
			$id_arr = $thisQuery_obj->sql->id_arr;

			if (count($id_arr) > 1) {	//If there was only 1 field to select, but that field is actually made up of multiple fields (e.g. temp_diff).
				$hasSubfield = true;
			} else {	//If there was only 1 field to select and it IS NOT actually made up of multiple fields.
				$hasSubfield = false;
			}
		} else {	//If there are multiple fields to select (i.e. subqueries needed).
			$hasSubfield = true;
			$thisQuery_obj->sql->field = $id;
			$id_arr = idMultiStrToArr($id);
		}
		//End: Test whether subqueries are needed.



		//Generating subqueries (if necessary).
		if (!$hasSubfield) {	//If subqueries are NOT needed.
			$from = $thisQuery_obj->sql->from;
			$db = $thisQuery_obj->sql->db;

			if (!$thisQuery_obj->sql->fromPseudoTable) {
				$thisQuery_obj->sql->from = "$db.$from $from ";
			} else {
				$thisQuery_obj->sql->from = "( \n $from \n ) sub ";
			}
		} else {	//If subqueries are needed.
			$from_sub = '';
			$where = "where 1 = 1 ";

			foreach ($id_arr as $key=>$value) {	//Loop thru each subfield.
				$subquery_obj = create_definition($value, $year);
				$id = $subquery_obj->sql->id;
				$where_realistic = $subquery_obj->sql->where_realistic;

				$sub_alias = 'sub' . ($key + 1);
				

				if ($subquery_obj->sql->nullToZero) {	//If it's a null-to-zero field.
					$where_realistic = str_replace($id, "isNull($id, 0)", $where_realistic);
				} else {
					$where_realistic = str_replace($alias, $id, $where_realistic);
				}

				if ($where_realistic) {
					if ($where_realistic_all !== '') {
						$where_realistic_all .=
							" \n" .
							"and ";
					}

					$where_realistic_all .= "( $where_realistic )";
				}


				$join = $subquery_obj->sql->join;

				if ($from_sub !== '') {
					$join_type = "$join join";
					$join_field = 
						"on sub1.$const->field_id = $sub_alias.$const->field_id \n" .
						"and sub1.$const->field_year = $sub_alias.$const->field_year ";
					$join_field = indent($join_field, 2);
				} else {
					$join_type = '';
					$join_field = '';
				}


				$obj = create_subquery($value, $year);
				$query = $obj->query;


				$from_sub .= 
					"$join_type ( \n" .
					indent($query, 1) . " \n" .
					") $sub_alias \n" .
					$join_field;
			}

			$thisQuery_obj->sql->from = $from_sub;
		}
		//End: Generating subqueries (if necessary).



		//Getting necessary variables ready.
		$field = $thisQuery_obj->sql->field;
		$id = $thisQuery_obj->sql->id;
		$from = $thisQuery_obj->sql->from;
		$db = $thisQuery_obj->sql->db;
		$where_local = $thisQuery_obj->sql->where_local;
		$where_realistic = $thisQuery_obj->sql->where_realistic;

		if ($thisQuery_obj->sql->nullToZero) {	//If it's a null-to-zero field.
			$where_realistic = str_replace($id, "isNull($id, 0)", $where_realistic);
		} else {
			$where_realistic = str_replace($alias, $id, $where_realistic);
		}
		
		if ($thisQuery_obj->sql->select_distinct) {
			$select = 'select distinct';
		} else {
			$select = 'select';
		}

		$where = "where $const->field_year >= '$year'";
		//End: Getting necessary variables ready.



		//Create local where clause.
		if ($where_local) {
			$where_local =
				"and ( \n" .
				indent($where_local, 1) . " \n" .
				")";

			$where =
				$where . " \n" .
				indent($where_local, 1);
		}
		//End: Create local where clause.



		//Create realistic where clause. This will be part of the where clause in the parent query (not this query).
		if ($where_realistic_all) {
			$where_realistic_all =
				"and ( \n" .
				indent($where_realistic_all, 1) . " \n" .
				")";

			$where =
				$where . " \n" .
				indent($where_realistic_all, 1);
		}
		//End: Create realistic where clause.



		//Create this query.
		$query = 
			"$select $field as $alias, $const->field_id, $const->field_year \n" .
			"from $from \n" .
			$where;
		//End: Create this query.



		//Handle output.
		$output = new stdClass();
		$output->query = $query;
		$output->where_realistic = $where_realistic;


		return $output;
		//End: Handle output.
	}

?>








