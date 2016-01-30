<?php
	function categoryCreate($area) {

		//Function continues below...
?>
		
		<div class="m-category">
			<?php echo formElemCreate("category", null, $area); ?>
			<div class="filter-wrap row"></div>
		</div>


		<script src="<?php echo WEB_ROOT . "/module/category/dist/script.min.js"; ?>"></script>

<?php
		//...function continues from above.
	}
?>