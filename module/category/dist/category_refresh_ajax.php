<?php
	require_once(SERVER_ROOT . '/php/dist/extension.php');
	require_once(SERVER_ROOT . '/module/definition/module.php');
	require_once(SERVER_ROOT . '/module/form_elem/module.php');
	require_once(SERVER_ROOT . '/module/category/dist/id_from_first_options.php');

	$server = getenv("server");
	$user_ro = getenv("userRO");
	$pass_ro = getenv("passRO");
	$db = getenv("db");

	$error_arr = array();
	$html = "";
	
	$name_id = json_decode($_POST["name_id"]);
	$id_first_part = json_decode($_POST["id_first_part"]);


	// Create connection
	$conn = new mysqli($server, $user_ro, $pass_ro, $db);
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
	  $error_arr[] = $conn->error;
	}

	$result = $conn->query($sql);


	while($row = $result->fetch_assoc()) {
		$child_name_id = $row["child_name_id"];
		$html_class = $row["html_class"];

		$html .= formElemCreate($child_name_id, $html_class);
	}
	


	$id_second_part = idFromFirstOptions($html);

	$id = idWrapAdd("$id_first_part $id_second_part");


	$def = definitionCreate($id);

	$filter_type = $def->info->filter_type;


	if(count($error_arr) === 0) {
    $conn->commit();
    $status = "success";
	} else {
	  $conn->rollback();
	  $status = "failure";
	}


	$output = new stdClass();
	$output->html = $html;
	$output->status = $status;
	$output->errorArr = $error_arr;
	// $output->debugSQL = $sql;
	$output->id = $id;
	$output->filter_type = $filter_type;

	echo json_encode($output);


	$conn->close();
?>










