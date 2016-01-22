<?php
	
	$general_id = $param[1]->value;
	$general_name = $param[1]->text;
  $specific_id = $param[2]->value;
  $specific_name = $param[2]->text;

	$title = "BOP $general_name ($specific_name)";
  $unit = 'lbs';

	$id = fieldWrapAdd("$type $general_id $specific_id");
	$field = 'act_wt';
  $from = 'bop_ht_mad_add';
  $join = 'left outer';
  $nullToZero = true;


	switch ($general_id) {
    case 'bop_ladle_al':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "and mat_cd = 'foo' ";
          $where_realistic = "$id > foo";
          break;
        case 'shred':
          $where_local = "and mat_cd = 'foo' ";
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
    case 'bop_ladle_mn':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "and mat_cd = 'foo' ";
          break;
        case 'reg':
          $where_local = "and mat_cd = '05' ";
          break;
        case 'mc':
          $where_local = "and mat_cd = '12' ";
          break;
        case 'cf93':
          $where_local = "and mat_cd = 'foo' ";
          break;
        case 'cf95':
          $where_local = "and mat_cd = 'foo' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_c':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "and mat_cd = 'foo' ";
          break;
        case 'coke_bag':
          $where_local = "and mat_cd = '81' ";
          break;
        case 'coke_sack':
          $where_local = "and mat_cd = 'CS' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_si':
      $where_local = "and mat_cd = '15' ";
      break;
    case 'bop_ladle_b':
      $where_local = "and mat_cd = '62' ";
      break;
    case 'bop_ladle_cb':
      $where_local = "and mat_cd = '26' ";
      break;
    case 'bop_ladle_ti':
      $where_local = "and mat_cd = '95' ";
      break;
    case 'bop_ladle_p':
      $where_local = "and mat_cd = '24' ";
      break;
    case 'bop_ladle_slagcnd':
      $where_local = "and mat_cd = '43' ";
      break;
    case 'bop_ladle_dsf':
      $where_local = "and mat_cd = '97' ";
      break;
    default:
    	break;
	}


	



?>