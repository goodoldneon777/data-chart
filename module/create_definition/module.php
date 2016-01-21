<?php

	function create_definition($id) {
		require (SERVER_ROOT . '/php/dist/constant.php');
		require_once (SERVER_ROOT . '/php/dist/extension.php');


		$param = idToParam($id);
		$type = $param[0]->value;


		require (SERVER_ROOT . '/module/create_definition/dist/type_' . $type . '.php');
		

		if (!isset($field)) {
			$field = $id;
		}

		if (!isset($id_arr)) {
			$id_arr = null;
		}

		if (!isset($from)) {
			$from = null;
		}

		if (!isset($db)) {
			$db = $const->db;
		}

		if (!isset($where_local)) {
			$where_local = null;
		}

		if (!isset($where_realistic)) {
			$where_realistic = null;
		}

		if (!isset($select_distinct)) {
			$select_distinct = false;
		}

		if (!isset($join)) {
			$join = 'inner';
		}

		if (!isset($nullToZero)) {
			$nullToZero = false;
		}



		$info = new stdClass();
		$info->type = $type;
		$info->title = $title;
		$info->unit = $unit;


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


		$output = new stdClass();
		$output->info = $info;
		$output->sql = $sql;


		return $output;
	}

?>







