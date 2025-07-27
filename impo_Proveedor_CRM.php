<?php
	
	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_PROVEE");
	saprfc_import ($fce,"SKIP_SELSCREEN","X");
	saprfc_import ($fce,"USERGROUP","RFC_USERS");
	saprfc_import ($fce,"VARIANT","");
	saprfc_import ($fce,"WORKSPACE","");
	//Fill internal tables
	saprfc_table_init ($fce,"FPAIRS");
	saprfc_table_init ($fce,"LDATA");
	saprfc_table_init ($fce,"LISTDESC");
	saprfc_table_init ($fce,"SELECTION_TABLE");
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00001","KIND"=>"S","SIGN"=>"I","OPTION"=>"EQ","LOW"=>"AR20","HIGH"=>""));
	
	//Do RFC call of function RSAQ_REMOTE_QUERY_CALL, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>Proveedores ");
	
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
		$pro = New Cliente_CRM_TODO();
		$pro = $pro->cliente_de_UN($value[LIFNR],$value[EKORG]);
		$pro->TICL='Proveedor';
		$pro->TIPO_ENTIDAD='Proveedor SAP';
		$pro->KUNNR=$value[LIFNR];
		$pro->VKORG=$value[EKORG];
		foreach ($value as $k=>$v) {
			$pro->$k=$v;
		}
		$pro->REGIO01=$pro->REGIO;
		$pro->save();
	    if (!$serv->is_running()){exit;}		
	}
	saprfc_function_free($fce);
	
	unset($tabla,$value,$pro,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);
	
/****************************************************************
 * 
 * 
 *       se trata PE10
 * 
 * 
 * 
 * 
 ********************************************************************/
	
	
	
	
	
	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_PROVEE");
	saprfc_import ($fce,"SKIP_SELSCREEN","X");
	saprfc_import ($fce,"USERGROUP","RFC_USERS");
	saprfc_import ($fce,"VARIANT","");
	saprfc_import ($fce,"WORKSPACE","");
	//Fill internal tables
	saprfc_table_init ($fce,"FPAIRS");
	saprfc_table_init ($fce,"LDATA");
	saprfc_table_init ($fce,"LISTDESC");
	saprfc_table_init ($fce,"SELECTION_TABLE");
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00001","KIND"=>"S","SIGN"=>"I","OPTION"=>"EQ","LOW"=>"PE10","HIGH"=>""));
	
	//Do RFC call of function RSAQ_REMOTE_QUERY_CALL, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>Proveedores ");
	
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
		$pro = New Cliente_CRM_TODO();
		$pro = $pro->cliente_de_UN($value[LIFNR],$value[EKORG]);
		$pro->TICL='Proveedor';
		$pro->TIPO_ENTIDAD='Proveedor SAP';
		$pro->KUNNR=$value[LIFNR];
		$pro->VKORG=$value[EKORG];
		foreach ($value as $k=>$v) {
			$pro->$k=$v;
		}
		$pro->REGIO01=$pro->REGIO;
		$pro->save();
	    if (!$serv->is_running()){exit;}		
	}
	saprfc_function_free($fce);
	
	unset($tabla,$value,$pro,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);
	
	
?>