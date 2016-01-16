<?php
	
	function create_formElem($name_id, $html_class = null, $input_area = null) {
		require_once(SERVER_ROOT . '/module/create_formElem/dist/create_select.php');
		require_once(SERVER_ROOT . '/module/create_formElem/dist/create_input.php');

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
		$tooltip = $row["tooltip"];
		//>>>


		//<<< Handle different types of write inputs.
		if ($html_type === 'select') {	//Generate dropdown html.
			$html = create_select($name_id, $title, $html_class, $tooltip, $input_area);
		} else if ($html_type === 'input') {	//Generate input html.
			$html = create_input($name_id, $title, $html_class, $tooltip, $input_area);			
		}
		//>>>


		$conn->close();


		return $html;
		// return $sql;
	}

?>




