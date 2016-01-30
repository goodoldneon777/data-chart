<?php
	function categoryFilterCreate($filter_type) {
    require(SERVER_ROOT . '/module/form_elem/module.php');

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





		return $html;
	}
?>