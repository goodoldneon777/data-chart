<?php

	function create_definition($id, $year) {
		require (SERVER_ROOT . '/php/dist/constant.php');
		require_once (SERVER_ROOT . '/php/dist/extension.php');


		$param = idToParam($id);
		$type = $param[0]->value;


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
		


		require (SERVER_ROOT . '/module/create_definition/dist/type_' . $type . '.php');
		

		if (!isset($field)) {
			$field = $id;
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
		$sql->fromPseudoTable = $fromPseudoTable;


		$output = new stdClass();
		$output->info = $info;
		$output->sql = $sql;


		return $output;
	}

?>







