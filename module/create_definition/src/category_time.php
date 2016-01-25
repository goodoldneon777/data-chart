<?php
	
	$test_id = $param[1]->value;
	$test_name = $param[1]->text;

	$title = $test_name . ' Time';
	$id = idWrapAdd($category . ' ' . $test_id);

	$unit = null;


	switch ($test_id) {
    case 'tap':
      $field = 'tap_dt';
      $from = 'bop_ht';
      break;
    default:
    	break;
	}


	


?>