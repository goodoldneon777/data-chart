<?php

	function create_input($name_id, $title, $html_class = "", $tooltip = null, $input_area = null) {
		require(SERVER_ROOT . '/php/dist/sql_openConn.php');


		$html = '<span class="elem-title">' . $title . '</span>';


		if ($tooltip !== null) {
	  	$html .= '<input class="' . $html_class . ' form-control" type="text" data-toggle="tooltip" title="' . $tooltip . '">';
		} else {
			$html .= '<input class="' . $html_class . ' form-control" type="text" >';
		}


		$html .= '<span></span>';


		$conn->close();

		return $html;
	}

?>