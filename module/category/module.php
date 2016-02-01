<?php
	function categoryCreate($area) {
		require_once(SERVER_ROOT . '/php/dist/extension.php');
		require_once(SERVER_ROOT . '/module/definition/module.php');
  	require_once(SERVER_ROOT . '/module/form_elem/module.php');
		require_once(SERVER_ROOT . '/module/category/dist/id_from_first_options.php');

		$html_class = "m-category";

		switch ($area) {
			case 'y-axis':
				$html_class .= " areatype-axis";
				break;
			case 'x-axis':
				$html_class .= " areatype-axis";
				break;
			case 'filters':
				$html_class .= " areatype-filters";
				break;
			default:
				break;
		}


		$category_html = formElemCreate("category", null, $area);

		$id = idFromFirstOptions($category_html);
		$id = idWrapAdd($id);

		$def = definitionCreate($id);
		$filter_type = $def->info->filter_type;


		$filter_wrap_html_class = 'filter-wrap row';

		if ($filter_type === 'none') {
			$filter_wrap_html_class .= ' hidden';
		}


		//Function continues below...
?>


	<link rel="stylesheet" media="screen" href="<?php echo WEB_ROOT . "/module/category/dist/style.min.css"; ?>">

		
		<div class="<?php echo $html_class; ?>">
		
			<div class="category-wrap">
				<?php echo $category_html; ?>
			</div>
	

			<div class="<?php echo $filter_wrap_html_class; ?>">
				<div class="operator-wrap col-xs-4 halfPad-xs">
					<?php echo formElemCreate("filter_operator", "operator"); ?>
				</div>

				<div class="col-xs-8 noPad-xs">
					<div class="equal-wrap col-xs-6 halfPad-xs hidden">
						<?php echo formElemCreate("filter_min", "equal"); ?>
					</div>

					<div class="min-wrap col-xs-6 halfPad-xs hidden">
						<?php echo formElemCreate("filter_min", "min"); ?>
					</div>

					<div class="max-wrap col-xs-6 halfPad-xs hidden">
						<?php echo formElemCreate("filter_max", "max"); ?>
					</div>
				</div>
			</div>

		</div>


		<script src="<?php echo WEB_ROOT . "/module/category/dist/script.min.js"; ?>"></script>


<?php
		//...function continues from above.
	}
?>