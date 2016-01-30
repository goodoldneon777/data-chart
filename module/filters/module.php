<?php

	function filtersCreate() {
		//Function continues...

?>


<link rel="stylesheet" media="screen" href="<?php echo WEB_ROOT . "/module/filters/dist/style.min.css"; ?>">

	<div class="m-filters">
		<form>

			<h4>Filter Item</h4>
			<div class="item area-wrap form-group">
					<?php echo create_formElem("category", "y-category", "y-axis"); ?>


				<div class="filter-wrap row">
					<div class="min-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("axis_min", "min"); ?>
					</div>


					<div class="max-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("axis_max", "max"); ?>
					</div>
				</div>

			</div>


		  
		</form>
	</div>



<script src="<?php echo WEB_ROOT . "/module/filters/dist/script.min.js"; ?>"></script>


<?php

	}

?>