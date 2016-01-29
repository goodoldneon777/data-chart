<?php

	function create_axes() {

		//Function continues...
?>


<link rel="stylesheet" media="screen" href="<?php echo WEB_ROOT . "/module/axes/dist/style.min.css"; ?>">


	<div class="m-axes">
		<form>

			<h4>Y-Axis</h4>
			<div class="y-axis area-wrap form-group">
					<?php echo create_formElem("category", "y-category category", "y-axis"); ?>


				<div class="filter-wrap row">
					<div class="min-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("axis_min", "min"); ?>
					</div>


					<div class="max-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("axis_max", "max"); ?>
					</div>
				</div>

			</div>



			<h4>X-Axis</h4>
			<div class="x-axis area-wrap form-group">
				<?php echo create_formElem("category", "x-category category", "x-axis"); ?>

				<div class="filter-wrap row hidden">
					<div class="min-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("axis_min", "min"); ?>
					</div>

					<div class="max-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("axis_max", "max"); ?>
					</div>
				</div>


				<div class="round-wrap row">
					<div class="round-factor-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("axis_round_factor", "round-factor"); ?>
					</div>

					<div class="round-count-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("axis_round_count", "round-count"); ?>
					</div>
				</div>

			</div>



			<h4>Main Filters</h4>
			<div class="filter-main form-group">

				<div class="row">
					<div class="dateMin-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("date_min", "date-min"); ?>
					</div>


					<div class="dateMax-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("date_max", "date-max"); ?>
					</div>
				</div>


				<div class="row">
					<div class="col-xs-3"></div>
					<div class="tapGrade-wrap col-xs-6 noPad-xs">
						<?php echo create_formElem("tap_grade", "tap-grade"); ?>
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