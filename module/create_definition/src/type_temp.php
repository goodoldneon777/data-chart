<?php
	
	$test_id = $param[1]->value;
	$test_name = $param[1]->text;

	$title = 'Temp ' . $test_name;
	$id = fieldWrapAdd("$type $test_id");

	$unit = '°F';


	switch ($test_id) {
    case 'hm_ladle':
      $field = 'hm_ldl_act_tp';
      $from = 'bop_ht';
      $where_realistic = "$id > 2000";
      break;
    case 'tap':
      $field = 'tap_tp';
      $from = 'bop_ht';
      $where_realistic = "$id > 2800";
      break;
    case 'tol':
      $field = 'TOL_tp';
      $from = 'bop_ht';
      $where_realistic = "$id > 2800";
      break;
    case 'ar_arrive':
      $field = 'samp_tp';
      $from = 'ms_chem_celox';
      $where_local =
      	"  and fac_id = 'A' \n" .
				"  and samp_designation = 'ARV' ";
      $where_realistic = "$id > 2800";
      break;
    case 'ar_leave':
      $field = 'samp_tp';
      $from = 'ms_chem_celox';
      $where_local =
        "  and fac_id = 'A' \n" .
        "  and samp_designation = 'LV' ";
      $where_realistic = "$id > 2800";
      break;
    case 'rh_arrive':
      $field = 'samp_tp';
      $from = 'ms_chem_celox';
      $where_local =
        "  and fac_id = 'V' \n" .
        "  and samp_designation = 'ARV' ";
      $where_realistic = "$id > 2800";
      break;
    case 'rh_deox':
      $field = 'samp_tp';
      $from = 'ms_chem_celox';
      $where_local =
        "  and fac_id = 'V' \n" .
        "  and samp_designation = 'DX' ";
      $where_realistic = "$id > 2800";
      break;
    case 'rh_leave':
      $field = 'samp_tp';
      $from = 'ms_chem_celox';
      $where_local =
        "  and fac_id = 'V' \n" .
        "  and samp_designation = 'LV' ";
      $where_realistic = "$id > 2800";
      break;
    case 'ct1':
      $field = 'samp_tp';
      $from = 'ms_chem_celox';
      $where_local =
        "  and fac_id = 'C' \n" .
        "  and samp_designation = 'CT1' ";
      $where_realistic = "$id > 2800";
      break;
    case 'ct2':
      $field = 'samp_tp';
      $from = 'ms_chem_celox';
      $where_local =
        "  and fac_id = 'C' \n" .
        "  and samp_designation = 'CT2' ";
      $where_realistic = "$id > 2800";
      break;
    case 'ct3':
      $field = 'samp_tp';
      $from = 'ms_chem_celox';
      $where_local =
        "  and fac_id = 'C' \n" .
        "  and samp_designation = 'CT3' ";
      $where_realistic = "$id > 2800";
      break;
    case 'melter_aim':
      $field = 'melter_aim_tap_tp';
      $from = 'bop_ht';
      $where_realistic = "$id > 2800";
      break;
    case 'melter_aim':
      $field = 'melter_aim_tap_tp';
      $from = 'bop_ht';
      $where_realistic = "$id > 2800";
      break;
    case 'charge_aim':
      $field = 'mdl_aim_tap_tp';
      $from = 'bop_ht';
      $where_realistic = "$id > 2800";
      break;
    default:
    	break;
	}

	


?>