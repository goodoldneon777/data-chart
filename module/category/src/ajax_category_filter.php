<?php
	require_once(SERVER_ROOT . '/php/dist/extension.php');
	require_once(SERVER_ROOT . '/module/definition/module.php');
  require_once(SERVER_ROOT . '/module/form_elem/module.php');

	$param_array = json_decode($_POST["param_array"]);
	$area = json_decode($_POST["area"]);


	$id = paramToId($param_array);
	$def = definitionCreate($id);
	$filter_type = $def->info->filter_type;


	switch ($area) {
		case 'axis':
			switch ($filter_type) {
				case 'none':
					$html = '';
					break;
				default:
					$html =
						"<div class=\"min-wrap col-xs-6 noPad-xs\"> \n" .
							formElemCreate("axis_min", "min") .
						"</div> \n" .
						"<div class=\"max-wrap col-xs-6 noPad-xs\"> \n" .
							formElemCreate("axis_max", "max") .
						"</div>";
					break;
			}
			break;
		case 'filters':
			switch ($filter_type) {
				case 'none':
					$html = '';
					break;
				default:
					$html =
						formElemCreate("filter_operator", "operator");
					break;
			}
			break;
		default:
			$html = $area;
			break;
	}


	echo json_encode($html);
?>