<html>


<div style="font-family:courier new; font-size:0.8em;">

<?php

	require_once(SERVER_ROOT . '/module/create_query/module.php');


	$m_axes = new stdClass();
	$y_axis = new stdClass();
	$x_axis = new stdClass();
	$filter_main = new stdClass();
	$p0 = new stdClass();
	$p1 = new stdClass();
	$p2 = new stdClass();
	$p3 = new stdClass();
	$p4 = new stdClass();


	
	//Y-axis set up.
	$p0->value = 'yield';
	$p0->text = 'Temperature';
	$p1->value = 'bop';
	$p1->text = 'Temperature';
	$p2->value = 'C';
	$p2->text = '';
	$p3->value = 'BLAD';
	$p3->text = 'Tap';
	$p4->value = 'C';
	$p4->text = 'Tap';

	$field = $p0->value;
	$param = array($p0, $p1, $p2);
	
	$y_axis->field = $field;
	$y_axis->param = $param;

	$m_axes->y_axis = $y_axis;
	//End: Y-axis set up.



	//X-axis set up.
	$p1 = new stdClass();
	$p2 = new stdClass();
	$p1->value = 'time';
	$p1->text = 'Time';
	$p2->value = 'tap';
	$p2->text = 'Tap';

	$field = 'time';
	$param = array($p1, $p2);

	$x_axis->field = $field;
	$x_axis->param = $param;
	$x_axis->round_factor = null;

	$m_axes->x_axis = $x_axis;
	//End: X-axis set up.



	//Main filter set up.
	$filter_main->year_min = '15';
	$filter_main->date_min = '12/1/2015';
	$filter_main->date_max = null;
	$filter_main->tap_grade = null;

	$m_axes->filter_main = $filter_main;
	//End: Main filter set up.



	$query = create_query($m_axes);



	echo nl2br(spaceToNbsp($query));


?>

</div>


</html>