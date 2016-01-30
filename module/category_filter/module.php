<?php
	function categoryFilterCreate($filter_type) {
    require(SERVER_ROOT . '/module/create_formElem/module.php');

		switch ($filter_type) {
			case 'none':
				$html = '';
				break;
			default:
				$html =
					"<div class=\"min-wrap col-xs-6 noPad-xs\"> \n" .
						create_formElem("axis_min", "min") .
					"</div> \n" .
					"<div class=\"max-wrap col-xs-6 noPad-xs\"> \n" .
						create_formElem("axis_max", "max") .
					"</div>";
				break;
		}





		return $html;
	}
?>