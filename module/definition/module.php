<?php

	function definitionCreate($id, $year_min = null) {
		require (SERVER_ROOT . '/php/dist/constant.php');
		require_once (SERVER_ROOT . '/php/dist/extension.php');


		$param = idToParam($id);
		$category = $param[0]->value;

		$title = null;
		$unit = null;
		$datatype = 'linear';
		$filter_type = 'default';
		

		$field = null;
		$id_arr = null;
		$from = null;
		$db = $const->db;
		$where_local = null;
		$where_realistic = null;
		$select_distinct = false;
		$join = 'inner';
		$nullToZero = false;
		$fromPseudoTable = false;


		require (SERVER_ROOT . '/module/definition/dist/category_' . $category . '.php');
		

		if (!isset($field)) {
			$field = $id;
		}



		$info = new stdClass();
		$info->category = $category;
		$info->title = $title;
		$info->unit = $unit;
		$info->datatype = $datatype;
		$info->filter_type = $filter_type;


		$sql = new stdClass();
		$sql->field = $field;
		$sql->id = $id;
		$sql->id_arr = $id_arr;
		$sql->from = $from;
		$sql->db = $db;
		$sql->where_local = $where_local;
		$sql->where_realistic = $where_realistic;
		$sql->select_distinct = $select_distinct;
		$sql->join = $join;
		$sql->nullToZero = $nullToZero;
		$sql->fromPseudoTable = $fromPseudoTable;


		$output = new stdClass();
		$output->info = $info;
		$output->sql = $sql;


		return $output;
	}

?>







