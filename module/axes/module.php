<?php

	function axesCreate() {
		require_once(SERVER_ROOT . '/module/category/module.php');
		//Function continues...
?>


<link rel="stylesheet" media="screen" href="<?php echo WEB_ROOT . "/module/axes/dist/style.min.css"; ?>">


	<div class="m-axes">
		<form>

			<h4>Y-Axis</h4>
			<div class="y-axis category-wrap form-group">
				<?php echo categoryCreate("y-axis"); ?>
			</div>



			<h4>X-Axis</h4>
			<div class="x-axis form-group">
				<?php echo categoryCreate("x-axis"); ?>
		
				<div class="round-wrap row">
					<div class="round-factor-wrap col-xs-6 noPad-xs">
						<?php echo formElemCreate("axis_round_factor", "round-factor"); ?>
					</div>

					<div class="round-count-wrap col-xs-6 noPad-xs">
						<?php echo formElemCreate("axis_round_count", "round-count"); ?>
					</div>
				</div>
			</div>
		


			<h4>Main Filters</h4>
			<div class="filter-main form-group">

				<div class="row">
					<div class="dateMin-wrap col-xs-6 noPad-xs">
						<?php echo formElemCreate("date_min", "date-min"); ?>
					</div>


					<div class="dateMax-wrap col-xs-6 noPad-xs">
						<?php echo formElemCreate("date_max", "date-max"); ?>
					</div>
				</div>


				<div class="row">
					<div class="col-xs-3"></div>
					<div class="tapGrade-wrap col-xs-6 noPad-xs">
						<?php echo formElemCreate("tap_grade", "tap-grade"); ?>
					</div>
					<div class="col-xs-3"></div>
				</div>

			</div>


			<!-- <button type="button" class="submitBtn btn btn-xlarge btn-success">Generate Chart</button> -->

		  
		</form>
	</div>



<script src="<?php echo WEB_ROOT . "/module/axes/dist/script.min.js"; ?>"></script>


<?php

	}

?>