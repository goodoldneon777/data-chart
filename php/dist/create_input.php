<?php
	
	function create_input($name_id, $html_class = null, $input_area = null) {
		$server = getenv('server');
		$userWR = getenv('userRO');
		$passWR = getenv('passRO');
		$db = getenv('db');

		$html = '';

		if ($html_class === null) {
			$html_class = "";
		}


		// Create connection
		$conn = new mysqli($server, $userWR, $passWR, $db);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		} 


		//<<< Get input info.
		$sql = 
			"select html_type, title, tooltip \n" .
			"from param_input \n" .
			"where name_id = '" . $name_id . "' \n";

		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$html_type = $row["html_type"];
		$title = $row["title"];
		$title_short = $row["title_short"];
		$tooltip = $row["tooltip_info"];

		if ($title_short === null) {
			$title_short = $title;
		}
		//>>>


		//<<< Handle different types of write inputs.
		if ($html_type === 'select') {	//Generate dropdown html.
			switch ($input_area) {
				case "y-axis":
					$show_filter = "and o.show_yaxis_flag = 1 ";
					break;
				case "x-axis":
					$show_filter = "and o.show_xaxis_flag = 1 ";
					break;
				case "filter":
					$show_filter = "and o.show_filter_flag = 1 ";
					break;
				default:
					$show_filter = "";
					break;
			}

			$sql =
				"select d.name_id, d.title, d.tooltip, o.order_num, o.option_value, o.option_text \n" .
				"from param_input d \n" .
				"inner join param_dropdown_option o \n" .
				"	on d.name_id = o.name_id \n" .
				"where \n" .
				"  d.name_id = '" . $name_id . "' \n" .
				"  " . $show_filter . " \n" .
				"order by o.order_num asc \n";


			$result = $conn->query($sql);


			$count = 1;
			if ($result->num_rows > 0) {
				$valueInList = false;	//Initialize. $valueInList will be used later to determine whether $value isn't an option in the param_dropdown table.

				while($row = $result->fetch_assoc()) {
					$option_value = $row["option_value"];
					$option_text = $row["option_text"];

					if ($count === 1) {
						if ($tooltip !== 'null') {
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
				$html = 'none';
			}

			//End of 'select' html generation.
		} else if ($html_type === 'input') {	//Generate input html.			
			$html .= '<span class="elem-title">' . $title . '</span>';


			if ($tooltip !== 'null') {
		  	$html .= '<input class="' . $html_class . ' form-control" type="text" data-toggle="tooltip" title="' . $tooltip . '">';
			} else {
				$html .= '<input class="' . $html_class . ' form-control" type="text" >';
			}


			$html .= '<span></span>';

			//End of 'input' html generation.
		} else if ($html_type === 'textarea') {	//Generate textarea html.

			if ($title_short === null) {
				$title_short = $title;
			}

			$html .=
				'<span class="elem-title hidden-xs">' . $title . '</span>' .
				'<span class="elem-title visible-xs" style="font-size:0.9em;">' . $title_short . '</span>';


			if ($tooltip !== 'null') {
		  	$html .= '<textarea class="form-control" data-toggle="tooltip" title="' . $tooltip . '">' . $value . '</textarea>';
			} else {
				$html .= '<textarea class="form-control">' . $value . '</textarea>';
			}


			$html .= '<span></span>';

			//End of 'input' html generation.
		}
		//>>>


		$conn->close();


		return $html;
		// return $sql;
	}

?>




