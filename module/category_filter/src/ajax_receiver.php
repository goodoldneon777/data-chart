<?php
	require(SERVER_ROOT . '/php/dist/extension.php');
	require(SERVER_ROOT . '/module/create_definition/module.php');
	require(SERVER_ROOT . '/module/category_filter/module.php');

	$param_array = json_decode($_POST["param_array"]);


	$id = paramToId($param_array);

	$def = create_definition($id);

	$filter_type = $def->info->filter_type;

	$html = categoryFilterCreate($filter_type);


	echo json_encode($html);
?>