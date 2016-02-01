<?php

	function create_select($name_id, $title, $html_class = "", $tooltip = null, $input_area = null) {
		require(SERVER_ROOT . '/php/dist/sql_openConn.php');

		//Initialize
		$html = '';
		$hasChildren = false;

		$html_class .= ' watch';


		switch ($input_area) {
			case "y-axis":
				$show_filter = "and o.show_in_yaxis_flag = 1 ";
				break;
			case "x-axis":
				$show_filter = "and o.show_in_xaxis_flag = 1 ";
				break;
			case "filters":
				$show_filter = "and o.show_in_filters_flag = 1 ";
				break;
			default:
				$show_filter = "";
				break;
		}

		$sql =
			"select d.name_id, d.title, d.tooltip, o.order_num, o.option_value, o.option_text, show_filter_flag \n" .
			"from param_input d \n" .
			"inner join param_dropdown_option o \n" .
			"	on d.name_id = o.name_id \n" .
			"where \n" .
			"  d.name_id = '" . $name_id . "' \n" .
			"  " . $show_filter . " \n" .
			"order by o.order_num asc \n";

		$resultOption = $conn->query($sql);


		$html .= '<div class="select-wrap">';


		$count = 1;
		if ($resultOption->num_rows > 0) {
			$valueInList = false;	//Initialize. $valueInList will be used later to determine whether $value isn't an option in the param_dropdown table.

			while($row = $resultOption->fetch_assoc()) {
				$option_value = $row["option_value"];
				$option_text = $row["option_text"];

				if ($count === 1) {
					$sql =
						"select c.child_name_id, c.html_class \n" .
						"from param_input_child c \n" .
						"where option_value = '" . $option_value . "' \n";

					$resultChild = $conn->query($sql);


					if ($resultChild->num_rows > 0) {
						$hasChildren = true;
						// $html_class .= ' watch';
					}


					if ($tooltip !== null) {
				  	$html .= '<select class="' . $html_class . ' form-control" data-toggle="tooltip" title="' . $tooltip . '">';
					} else {
						$html .= '<select class="' . $html_class . ' form-control">';
					}
				}


				$html .= '<option value="' . $option_value . '">' . $option_text . '</option>';

				$count++;
			}


			$html .= '</select>';
		} else {
			$html .= '{error: child not found}';
		}


		//Create elem expand (even if no children).
		$html .= '<div class="elem-expand">';

		if ($hasChildren) {
			while($row = $resultChild->fetch_assoc()) {
				$child_name_id = $row["child_name_id"];
				$html_class = $row["html_class"];

				$html .= create_select($child_name_id, "", $html_class);
			}

		}
		$html .= '</div>';	//Close 'elem-expand' div.


		$html .= '</div>';	//Close 'select-wrap' div.


		$conn->close();


		return $html;
	}

?>