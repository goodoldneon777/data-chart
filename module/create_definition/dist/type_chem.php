<?php
	
	$test_id = $param[1]->value;
	$test_name = $param[1]->text;
  $elem_id = strtoupper($param[2]->value);
  $elem_name = $param[2]->text;

	$title = "Chem $test_name $elem_name";
	$id = fieldWrapAdd("$type $test_id $elem_id");

	$unit = '%';


	switch ($test_id) {
    case 'hm_ladle':

      break;
    default:
      $field = 'elem_pct';
      $from = 'ms_ht_chem_anal';
      $where_local = "and elem_cd = '$elem_id'";
      $where_realistic = "and elem_cd = '$elem_id'";
    	break;
	}

	


?>