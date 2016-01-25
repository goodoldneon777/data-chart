<?php
	
	$timeType_id = $param[1]->value;
	$timeType_name = $param[1]->text;

	$title = $timeType_name . ' Time';
	$unit = null;
	$datatype = 'datetime';

	$id = idWrapAdd($category . ' ' . $timeType_id);


	switch ($timeType_id) {
    case 'tap':
      $field = 'tap_dt';
      $from = 'bop_ht';
      break;
    default:
    	break;
	}


	


?>