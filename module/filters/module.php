<?php

	function filtersCreate() {
		require_once(SERVER_ROOT . '/module/category/module.php');
  	require_once(SERVER_ROOT . '/module/form_elem/module.php');

		//Function continues...
?>


<link rel="stylesheet" media="screen" href="<?php echo WEB_ROOT . "/module/filters/dist/style.min.css"; ?>">

	<div class="m-filters">
		<form>

			<h4>Filter Item</h4>
			<div class="filter-item form-group">
				<?php echo categoryCreate("filters"); ?>
			</div>

			<h4>Filter Item</h4>
			<div class="filter-item form-group">
				<?php echo categoryCreate("filters"); ?>
			</div>


		  
		</form>
	</div>



<script src="<?php echo WEB_ROOT . "/module/filters/dist/script.min.js"; ?>"></script>


<?php

	}

?>