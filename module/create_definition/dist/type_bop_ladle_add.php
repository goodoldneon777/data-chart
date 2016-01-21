<?php
	
	$general_id = $param[1]->value;
	$general_name = $param[1]->text;
  $specific_id = $param[2]->value;
  $specific_name = $param[2]->text;

	$title = "BOP $general_name ($specific_name)";
  $unit = 'lbs';

	$id = fieldWrapAdd("$type $general_id $specific_id");
	$nullToZero = true;


	switch ($general_id) {
    case 'bop_ladle_al':

      switch ($specific_id) {
        case 'total':
          $where_local = "and mat_cd in ('13', '55') ";
          break;
        case 'cone':
          $where_local = "and mat_cd = '55' ";
          break;
        case 'bar':
          $where_local = "and mat_cd = '13' ";
          break;
        default:
          break;
      }
      break;
    default:
    	break;
	}


	
  if (!isset($field)) {
    $field = 'act_wt';
  }
  
  if (!isset($from)) {
    $from = 'bop_ht_mad_add';
  }
  
  if (!isset($join)) {
    $join = 'left outer';
  }


?>