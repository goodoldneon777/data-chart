<?php
	
  $singleOrDiff = $param[1]->value;

  $unit = '%';


	

	

  switch ($singleOrDiff) {
    case 'chem_single':
      $test_id = $param[2]->value;
      $test_name = $param[2]->text;
      $elem_id = strtoupper($param[3]->value);
      $elem_name = $param[3]->text;

      $title = "Chem $test_name $elem_name";
      $id = idWrapAdd("$category $test_id $elem_id");

    	switch ($test_id) {
        case 'BLAD':
          $field = 'elem_pct';
          $from = 'ms_ht_chem_samp_anal';
          $where_local =
            "test_id = 'BLAD' \n" .
            "and elem_cd = '$elem_id' ";
          break;
        case 'ILAD':
          $field = 'elem_pct';
          $from = 'ms_ht_chem_samp_anal';
          $where_local =
            "test_id = 'ILAD' \n" .
            "and elem_cd = '$elem_id' ";
          break;
        case 'dsf_start':
          $field = 'S_pct';
          $from = 'bop_ht_leco';
          $where_local = "test_typ = 'IS'";
          $where_realistic = "$id > 0";
          break;
        case 'dsf_init':
          $field = 'dslf_init_S';
          $from = 'bop_ht';
          $where_realistic = "$id > 0";
          break;
        case 'dsf_init':
          $field = 'dslf_init_S';
          $from = 'bop_ht';
          $where_realistic = "$id > 0";
          break;
        case 'dsf_final':
          $field = 'dslf_S_after_cycle';
          $from = 'bop_ht';
          $where_realistic = "$id between 0.001 and 0.050";
          break;
        case 'dsf_aim':
          $field = 'dslf_calc_aim_S';
          $from = 'bop_ht';
          $where_realistic = "$id >= 0.001";
          break;
        case 'rh_first':
          $elem_id = strtoupper($elem_id);
          $field = "elem_pct";
          $from = 'ms_ht_chem_anal';
          $db = 'USSGLW.dbo';
          $where_local =
            "elem_cd = '$elem_id' \n" .
            "and test_id = ( \n" .
            "  select min(test_id) \n" .
            "  from $db.$from as a \n" .
            "  where a.ht_num = $from.ht_num \n" .
            "    and a.tap_yr = $from.tap_yr \n" .
            "    and a.test_id like 'V%' \n" .
            "    and a.test_id not like 'V_L1' \n" .
            ")";
          break;
        case 'rh_last':
          $elem_id = strtoupper($elem_id);
          $field = "elem_pct";
          $table = 'ms_ht_chem_samp_anal';
          $from = 
            "select distinct ht_num, tap_yr, \n" .
            "  max(case when elem_cd = '$elem_id' then elem_pct) over(partition by ht_num, tap_yr) as elem_pct, \n" .
            "  max(case when elem_cd = 'AL' then elem_pct) over(partition by ht_num, tap_yr) as elem_pct_al \n" .
            "from $db.$table \n" .
            "where tap_yr >= '$year_min' \n" .
            "  and elem_cd = '$elem_id' \n" .
            "  and test_id = ( \n" .
            "    select max(test_id) \n" .
            "    from $db.$table as a \n" .
            "    where a.ht_num = $table.ht_num \n" .
            "      and a.tap_yr = $table.tap_yr \n" .
            "      and a.test_id like 'V%' \n" .
            ")";
          $where_local = "elem_pct_al > 0.010";
          $fromPseudoTable = true;
          break;
        case 'bop_aim':
          $field = 'mdl_aim_pct';
          $from = 'bop_chem_rec';
          $db = 'Alloy_Model.dbo';
          $where_local = 
            "fac_id not like '%S' \n" .
            "and fac_id not like '%T' \n" .
            "and elem_cd = '$elem_id' \n" .
            "and mdl_run_seq_num = ( \n" .  //This line (and the following 5) makes the query take only the last model run for each heat.
            "  select max(mdl_run_seq_num) \n" .
            "  from $db.$from as a \n" .
            "  where a.ht_num = $from.ht_num \n" .
            "    and a.tap_yr = $from.tap_yr \n" .
            "    and a.fac_id = $from.fac_id \n" .
            ")";
          break;
        case 'bop_start':
          $field = 'mdl_start_pct';
          $from = 'bop_chem_rec';
          $db = 'Alloy_Model.dbo';
          $where_local = 
            "fac_id not like '%S' \n" .
            "and fac_id not like '%T' \n" .
            "and elem_cd = '$elem_id' \n" .
            "and mdl_run_seq_num = ( \n" .  //This line (and the following 5) makes the query take only the last model run for each heat.
            "  select max(mdl_run_seq_num) \n" .
            "  from $db.$from as a \n" .
            "  where a.ht_num = $from.ht_num \n" .
            "    and a.tap_yr = $from.tap_yr \n" .
            "    and a.fac_id = $from.fac_id \n" .
            ")";
          break;
        case 'bop_final':
          $field = 'pred_final_pct';
          $from = 'bop_chem_rec';
          $db = 'Alloy_Model.dbo';
          $where_local = 
            "fac_id not like '%S' \n" .
            "and fac_id not like '%T' \n" .
            "and elem_cd = '$elem_id' \n" .
            "and mdl_run_seq_num = ( \n" .  //This line (and the following 5) makes the query take only the last model run for each heat.
            "  select max(mdl_run_seq_num) \n" .
            "  from $db.$from as a \n" .
            "  where a.ht_num = $from.ht_num \n" .
            "    and a.tap_yr = $from.tap_yr \n" .
            "    and a.fac_id = $from.fac_id \n" .
            ")";
          break;
        case 'ref_min':
          $field = 'min_pct';
          $from = 'ht_ref_chem_mod';
          $where_local = "elem_cd = '$elem_id'";
          break;
        case 'ref_max':
          $field = 'max_pct';
          $from = 'ht_ref_chem_mod';
          $where_local = "elem_cd = '$elem_id'";
          break;
        case 'ar_aim':
          $field = 'mdl_aim_pct';
          $from = 'ars_chem_rec';
          $db = 'Alloy_Model.dbo';
          $where_local = 
            "fac_id not like '%S' \n" .
            "and fac_id not like '%T' \n" .
            "and elem_cd = '$elem_id' \n" .
            "and mdl_run_seq_num = ( \n" .  //This line (and the following 5) makes the query take only the last model run for each heat.
            "  select max(mdl_run_seq_num) \n" .
            "  from $db.$from as a \n" .
            "  where a.ht_num = $from.ht_num \n" .
            "    and a.tap_yr = $from.tap_yr \n" .
            "    and a.fac_id = $from.fac_id \n" .
            ")";
          break;
        default:
          $test_id = strtoupper($test_id);
          $elem_id = strtoupper($elem_id);

          $field = 'elem_pct';
          $from = 'ms_ht_chem_anal';
          $where_local =
            "test_id like '$test_id' \n" .
            "and elem_cd = '$elem_id'";
          $where_realistic = "$id > 0.0";
        	break;
    	}
      break;
    case 'chem_diff':
      $test1_id = $param[2]->value;
      $test1_name = $param[2]->text;
      $test2_id = $param[3]->value;
      $test2_name = $param[3]->text;
      $elem_id = strtoupper($param[4]->value);
      $elem_name = $param[4]->text;

      $title = 'Chem Diff (' . $test1_name . ' - ' . $test2_name . ')';

      $field = "[chem chem_single $test1_id $elem_id] - [chem chem_single $test2_id $elem_id]";
      $id_arr = idMultiStrToArr($field);
      break;
    default:
      break;
  }





?>