<?php
	
	$general_id = $param[1]->value;
	$general_name = $param[1]->text;
  $specific_id = $param[2]->value;
  $specific_name = $param[2]->text;

	$title = "BOP $general_name ($specific_name)";
  $unit = 'lbs';

	$id = idWrapAdd("$category $general_id $specific_id");
	$field = 'act_wt';
  $from = 'bop_ht_mat_add';
  $join = 'left outer';
  $nullToZero = true;


	switch ($general_id) {
    case 'bop_ladle_AL':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "mat_cd = 'foo' ";
          break;
        case 'shred':
          $where_local = "mat_cd = '56' ";
          break;
        case 'cone':
          $where_local = "mat_cd = '55' ";
          break;
        case 'bar':
          $where_local = "mat_cd = '13' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_MN':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "mat_cd = 'foo' ";
          break;
        case 'reg':
          $where_local = "mat_cd = '05' ";
          break;
        case 'mc':
          $where_local = "mat_cd = '12' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_C':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "mat_cd = 'foo' ";
          break;
        case 'coke_bag':
          $where_local = "mat_cd = '81' ";
          break;
        case 'coke_sack':
          $where_local = "mat_cd = 'CS' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_SI':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "mat_cd = 'foo' ";
          break;
        case 'FeSi':
          $where_local = "mat_cd = '15' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_B':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "mat_cd = 'foo' ";
          break;
        case 'FeB':
          $where_local = "mat_cd = '62' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_CB':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "mat_cd = 'foo' ";
          break;
        case 'FeCb':
          $where_local = "mat_cd = '26' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_CR':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "mat_cd = 'foo' ";
          break;
        case 'FeCr':
          $where_local = "mat_cd = '31' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_TI':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "mat_cd = 'foo' ";
          break;
        case 'FeTi':
          $where_local = "mat_cd = '95' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_P':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "mat_cd = 'foo' ";
          break;
        case 'FeP':
          $where_local = "mat_cd = '24' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_V':
      switch ($specific_id) {
        case 'total_cntd':
          $where_local = "mat_cd = 'foo' ";
          break;
        case 'FeP':
          $where_local = "mat_cd = '16' ";
          break;
        default:
          break;
      }
      break;
    case 'bop_ladle_slagcnd':
      $where_local = "and mat_cd = '43' ";
      break;
    case 'bop_ladle_dsf':
      $where_local = "and mat_cd = '97' ";
      break;
    case 'bop_ladle_lime':
      $where_local = "and mat_cd = 'VN' ";
      break;
    default:
    	break;
	}


	



?>