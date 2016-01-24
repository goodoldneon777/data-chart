<?php
	
	$area_id = $param[1]->value;
	$area_name = $param[1]->text;
	$elem_id = strtoupper($param[2]->value);
	$elem_name = $param[2]->text;

	$title = "Yield: $area_name $elem_name";
	$id = idWrapAdd("$type $area_id $elem_id");

	$unit = '%';


	switch ($area_id) {
    case 'bop':
    	$field =
    		'( ' . idWrapAdd("chem chem_diff ILAD BLAD $elem_id") . ' ) / ' .
    		'( ' . idWrapAdd("bop_ladle_add bop_ladle_$elem_id total_cntd") . ' / 5000.0 )';
      $id_arr = idMultiStrToArr($field);
      break;
    default:
    	break;
	}


	


?>