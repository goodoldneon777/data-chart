<?php

	function fieldWrapAdd($str) {
		return '[' . $str . ']';
	}



	function fieldWrapRemove($str) {
		if (!fieldWrapExist($str)) {
			return false;
		}

		return substr($str, 1, strlen($str) - 2);
	}



	function fieldWrapExist($str) {
		// if (substr($str, 0, 1) === '['  &&  substr($str, -1, 1) === ']') {
		if (strpos($str, '[') >= 0  &&  strpos($str, ']') >= 0) {
			return true;
		} else {
			return false;
		}
	}



	function idToParam($str) {
		if (!fieldWrapExist($str)) {
			return false;
		}

		$str = fieldWrapRemove($str);

		$str_arr = explode(' ', $str);

		$arr = array();
		foreach ($str_arr as $key=>$value) {
			$elem = new stdClass();
			$elem->value = $value;
			$elem->text = '';

			array_push($arr, $elem);
		}

		return $arr;
	}



	function idMultiStrToArr($str) {
		if (!fieldWrapExist($str)) {
			return false;
		}

		preg_match_all("/\[[^\]]*\]/", $str, $match_arr);
		$id_arr = $match_arr[0];

		return $id_arr;
	}



	function indent($str, $count, $length = 2) {
		$char = ' ';
		$indent = '';

		for ($i = 1; $i <= $length; $i++) {
			$indent .= $char;
		}

		return $indent . str_replace("\n", "\n" . $indent, $str);
	}



	function spaceToNbsp($str) {
		return str_replace(' ', '&nbsp;', $str);
	}

	
?>