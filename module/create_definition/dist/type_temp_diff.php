<?php
	
	$test1_id = $param[1]->value;
	$test1_name = $param[1]->text;
  $test2_id = $param[2]->value;
  $test2_name = $param[2]->text;

	$title = 'Temp Diff (' . $test1_name . ' - ' . $test2_name . ')';
	$unit = '°F';
	

	$field = "[temp $test1_id] - [temp $test2_id]";
  $id_arr = array(
    '[temp ' . $test1_id . ']',
    '[temp ' . $test2_id . ']'
  );

	



?>