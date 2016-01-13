<?php

	function create_axes() {
		require_once(SERVER_ROOT . '/php/dist/create_input.php');

		//Function continues...

?>


<link rel="stylesheet" media="screen" href="<?php echo WEB_ROOT . "/module/axes/dist/style.min.css"; ?>">


<div class="m-axes panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Axes</h3>
	</div>

	<div class="panel-body">
		<form>

			<h4>Y-Axis</h4>
			<div class="y-axis form-group">
				<?php echo create_input("field", "y-field", "y-axis"); ?>


				<div class="field-expand"></div>


				<div class="filter-axis row">
					<div class="min-div col-xs-6 noPad-xs">
						<?php echo create_input("axis_min", "min"); ?>
					</div>


					<div class="max-div col-xs-6 noPad-xs">
						<?php echo create_input("axis_max", "max"); ?>
					</div>
				</div>

			</div>



			<!-- Horizontal break line -->
			<!-- <div class="col-xs-12"><hr></div> -->


			<h4>X-Axis</h4>
			<div class="x-axis form-group">
				<?php echo create_input("field", "x-field", "x-axis"); ?>


				<div class="field-expand"></div>


				<div class="filter-axis row">
					<div class="min-div col-xs-6 noPad-xs">
						<?php echo create_input("axis_min", "min"); ?>
					</div>


					<div class="max-div col-xs-6 noPad-xs">
						<?php echo create_input("axis_max", "max"); ?>
					</div>
				</div>


				<div class="row">
					<div class="col-xs-3"></div>
					<div class="round-div col-xs-6 noPad-xs">
						<?php echo create_input("axis_round", "round"); ?>
					</div>
					<div class="col-xs-3"></div>
				</div>

			</div>



			<!-- Horizontal break line -->
			<!-- <div class="col-xs-12"><hr></div> -->


			<h4>Main Filters</h4>
			<div class="filter-main form-group">

				<div class="row">
					<div class="dateMin-div col-xs-6 noPad-xs">
						<?php echo create_input("date_min", "date-min"); ?>
					</div>


					<div class="dateMax-div col-xs-6 noPad-xs">
						<?php echo create_input("date_max", "date-max"); ?>
					</div>
				</div>


				<div class="row">
					<div class="col-xs-3"></div>
					<div class="tapGrade-div col-xs-6 noPad-xs">
						<?php echo create_input("tap_Grade", "grade"); ?>
					</div>
					<div class="col-xs-3"></div>
				</div>

			</div>


			<button type="button" class="submitBtn btn btn-xlarge btn-success">Generate Chart</button>

		  
		</form>
	</div>
</div>


<script src="<?php echo WEB_ROOT . "/module/axes/dist/script.min.js"; ?>"></script>


<?php

	}

?>