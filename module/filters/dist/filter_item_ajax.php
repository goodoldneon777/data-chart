<?php
	require_once(SERVER_ROOT . '/module/filters/module.php');

	
	$html = filtersHTML();


	echo json_encode($html);
?>