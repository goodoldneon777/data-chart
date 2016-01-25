<?php
	// require_once(SERVER_ROOT . '/php/dist/create_input.php');
	require(SERVER_ROOT . '/module/create_formElem/module.php');

	$server = getenv("server");
	$userRO = getenv("userRO");
	$passRO = getenv("passRO");
	$db = getenv("db");

	$errorArr = array();
	$html = "";
	
	$name_id = json_decode($_POST["name_id"]);
	// $name_id = 'temp_diff';

	// Create connection
	$conn = new mysqli($server, $userRO, $passRO, $db);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 


	$sql = 
		"select c.child_name_id, c.html_class \n" .
		"from data_chart.param_input_child c \n" .
		"where c.option_value = '" . $name_id . "' \n" .
		"order by c.order_num \n";

	if (!$conn->query($sql)) {
	  $errorArr[] = $conn->error;
	}

	$result = $conn->query($sql);


	while($row = $result->fetch_assoc()) {
		$child_name_id = $row["child_name_id"];
		$html_class = $row["html_class"];

		$html .= create_formElem($child_name_id, $html_class);
	}
	


	if(count($errorArr) === 0) {
    $conn->commit();
    $status = "success";
	} else {
	  $conn->rollback();
	  $status = "failure";
	}


	$output = new stdClass();
	$output->html = $html;
	$output->status = $status;
	$output->errorArr = $errorArr;
	// $output->debugSQL = $sql;

	echo json_encode($output);


	$conn->close();
?>










