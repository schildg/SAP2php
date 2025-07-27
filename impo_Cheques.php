<?php
	$timestamp = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) - ( 15 * 60 * 60 * 24); //Menos 5 DIAS
	$fecha_Q_inicio = date("Ymd",$timestamp);
	$timestamp1 = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) + ( 1 * 60 * 60 * 24); //MAS 2 DIAS
	$fecha_Q_fin    =  date("Ymd",$timestamp1);


	
	
	
	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_CHEQUE");
	saprfc_import ($fce,"SKIP_SELSCREEN","X");
	saprfc_import ($fce,"USERGROUP","RFC_USERS");
	saprfc_import ($fce,"VARIANT","");
	saprfc_import ($fce,"WORKSPACE","");
	//Fill internal tables
	saprfc_table_init ($fce,"FPAIRS");
	saprfc_table_init ($fce,"LDATA");
	saprfc_table_init ($fce,"LISTDESC");
	saprfc_table_init ($fce,"SELECTION_TABLE");
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00001","KIND"=>"S","SIGN"=>"I","OPTION"=>"BT","LOW"=>$fecha_Q_inicio,"HIGH"=>$fecha_Q_fin));
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00003","KIND"=>"S","SIGN"=>"I","OPTION"=>"EQ","LOW"=>"S","HIGH"=>""));
	
	//Do RFC call of function RSAQ_REMOTE_QUERY_CALL, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>cheques ");
	
	$LISTTEXT = saprfc_export ($fce,"LISTTEXT");
	$LIST_ID = saprfc_export ($fce,"LIST_ID");
	$PROGRAM = saprfc_export ($fce,"PROGRAM");
	$USED_VARIANT = saprfc_export ($fce,"USED_VARIANT");
	$rows = saprfc_table_rows ($fce,"FPAIRS");
	for ($i=1;$i<=$rows;$i++)
		$FPAIRS[] = saprfc_table_read ($fce,"FPAIRS",$i);
	$rows = saprfc_table_rows ($fce,"LDATA");
	for ($i=1;$i<=$rows;$i++)
		$LDATA[] = saprfc_table_read ($fce,"LDATA",$i);
	$rows = saprfc_table_rows ($fce,"LISTDESC");
	for ($i=1;$i<=$rows;$i++)
		$LISTDESC[] = saprfc_table_read ($fce,"LISTDESC",$i);
	$rows = saprfc_table_rows ($fce,"SELECTION_TABLE");
	for ($i=1;$i<=$rows;$i++)
		$SELECTION_TABLE[] = saprfc_table_read ($fce,"SELECTION_TABLE",$i);
	//Debug info
	//saprfc_function_debug_info($fce);
	
	$tabla=cargo_desde_rfc($LDATA, $LISTDESC);
	if (!$serv->is_running()){exit;}		
	foreach ($tabla as $value) {
		$che = New Cheques_CRM_TODO();
		$che = $che->buscarExtendido($value[BUKRS],$value[BELNR],$value[GJAHR],$value[NCHCK]);
		foreach ($value as $k=>$v) {
			$che->$k=$v;
		}
		$che->save();
	    if (!$serv->is_running()){exit;}		
	}
	saprfc_function_free($fce);
	
	unset($tabla,$value,$che,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);
	
	/**************************************************************************
	 * 
	 * 
	 * 
	 * 
	 * 
	 * 
	 ***************************************************************************/
	
	
	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_CHEQUE");
	saprfc_import ($fce,"SKIP_SELSCREEN","X");
	saprfc_import ($fce,"USERGROUP","RFC_USERS");
	saprfc_import ($fce,"VARIANT","");
	saprfc_import ($fce,"WORKSPACE","");
	//Fill internal tables
	saprfc_table_init ($fce,"FPAIRS");
	saprfc_table_init ($fce,"LDATA");
	saprfc_table_init ($fce,"LISTDESC");
	saprfc_table_init ($fce,"SELECTION_TABLE");
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00001","KIND"=>"S","SIGN"=>"I","OPTION"=>"BT","LOW"=>$fecha_Q_inicio,"HIGH"=>$fecha_Q_fin));
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00002","KIND"=>"S","SIGN"=>"I","OPTION"=>"EQ","LOW"=>"S","HIGH"=>""));
	
	//Do RFC call of function RSAQ_REMOTE_QUERY_CALL, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>cheques ");
	
	$LISTTEXT = saprfc_export ($fce,"LISTTEXT");
	$LIST_ID = saprfc_export ($fce,"LIST_ID");
	$PROGRAM = saprfc_export ($fce,"PROGRAM");
	$USED_VARIANT = saprfc_export ($fce,"USED_VARIANT");
	$rows = saprfc_table_rows ($fce,"FPAIRS");
	for ($i=1;$i<=$rows;$i++)
		$FPAIRS[] = saprfc_table_read ($fce,"FPAIRS",$i);
	$rows = saprfc_table_rows ($fce,"LDATA");
	for ($i=1;$i<=$rows;$i++)
		$LDATA[] = saprfc_table_read ($fce,"LDATA",$i);
	$rows = saprfc_table_rows ($fce,"LISTDESC");
	for ($i=1;$i<=$rows;$i++)
		$LISTDESC[] = saprfc_table_read ($fce,"LISTDESC",$i);
	$rows = saprfc_table_rows ($fce,"SELECTION_TABLE");
	for ($i=1;$i<=$rows;$i++)
		$SELECTION_TABLE[] = saprfc_table_read ($fce,"SELECTION_TABLE",$i);
	//Debug info
	//saprfc_function_debug_info($fce);
	
	$tabla=cargo_desde_rfc($LDATA, $LISTDESC);
	if (!$serv->is_running()){exit;}		
	
	foreach ($tabla as $value) {
		$che = New Cheques_CRM_TODO();
		$che = $che->buscarExtendido($value[BUKRS],$value[BELNR],$value[GJAHR],$value[NCHCK]);
		foreach ($value as $k=>$v) {
			$che->$k=$v;
		}
		$che->DMBE2=$value[DMBE2001];
		$che->save();
	    if (!$serv->is_running()){exit;}		
	}
	saprfc_function_free($fce);
	
	unset($tabla,$value,$che,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);	
	
?>