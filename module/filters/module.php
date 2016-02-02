<?php

	function filtersCreate() {
		require_once(SERVER_ROOT . '/module/category/module.php');
  	require_once(SERVER_ROOT . '/module/form_elem/module.php');


  	ob_start();
		//Function continues...
?>


		<link rel="stylesheet" media="screen" href="<?php echo WEB_ROOT . "/module/filters/dist/style.min.css"; ?>">
		<link rel="stylesheet" media="screen" href="<?php echo WEB_ROOT . "/module/category/dist/style.min.css"; ?>">


		<div class="m-filters">
				<form>

		<?php echo filtersHTML(); ?>

			</form>
		</div>


		<script src="<?php echo WEB_ROOT . "/module/filters/dist/script.min.js"; ?>"></script>
		<script src="<?php echo WEB_ROOT . "/module/category/dist/script.min.js"; ?>"></script>


<?php
		//...function continues.

		$html = ob_get_clean();


		return $html;
	}
?>





<?php
	function filtersHTML() {
		require_once(SERVER_ROOT . '/module/category/module.php');


  	ob_start();
		//Function continues...
?>

		
		<div class="filter-item-wrap form-group">
			<h4>Filter Item</h4>
			<?php echo categoryHTML("filters"); ?>
		</div>
		  

<?php
		//...function continues.

		$html = ob_get_clean();


		return $html;
	}


?>