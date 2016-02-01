<?php
	
	$equip_id = $param[1]->value;
	$equip_name = $param[1]->text;

	// $title = $timeType_name . ' Time';
	$unit = null;
	$datatype = 'text';
	$filter_type = 'none';

	$id = idWrapAdd($category . ' ' . $equip_id);


	switch ($equip_id) {
    case 'stl_ldl':
      // $field = 'tap_dt';
      // $from = 'bop_ht';
      break;
    default:
    	break;
	}


	


?>