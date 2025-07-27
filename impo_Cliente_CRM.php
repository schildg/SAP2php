<?php

$serv->set_subestado("borro datos de vendedor");

$sql_ok = true; 
$sql = "TRUNCATE TABLE `vendedor_crm_tmp`";       //borro todo el vendedor
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}

/************************************************************************************
 *     A CONTINUACION SE TRATAN VENDEDORES DE ARGENTINA
 * 
 ************************************************************************************/

	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>VENDEDORES");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_VENDED");
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
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00002","KIND"=>"S","SIGN"=>"I","OPTION"=>"EQ","LOW"=>"ZV","HIGH"=>""));
	
	//Do RFC call of function RSAQ_REMOTE_QUERY_CALL, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>VENDEDORES ");
	
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
		$ve_crm = new Vendedor_CRM_TMP();
		foreach ($value as $k=>$v) {
			$ve_crm->$k=$v;
		}
		$ve_crm->save();
	    if (!$serv->is_running()){exit;}		
	}
	saprfc_function_free($fce);
	
	unset($tabla,$value,$cl_crm,$ve_crm,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);


/************************************************************************************
 *     A CONTINUACION SE TRATAN CLIENTES TRATADOS COMO DESCARGA DE ARGENTINA
 * 
 ************************************************************************************/

	

	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>CLIENTES");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_CLIEWE");
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
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00002","KIND"=>"S","SIGN"=>"I","OPTION"=>"EQ","LOW"=>"WE","HIGH"=>""));
	
	//Do RFC call of function RSAQ_REMOTE_QUERY_CALL, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>CLIENTES ");
	
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
		$cl_crm = new Cliente_CRM_TODO();
		$cl_crm = $cl_crm->cliente_de_UN($value[KUNNR],$value[VKORG]);
		foreach ($value as $k=>$v) {
			$cl_crm->$k=$v;
		}
		if(substr($cl_crm->KUNNR,0,6)=='000100'  ||  substr($cl_crm->KUNNR,0,6)=='000200'){
			$cl_crm->TICL='Descarga';		
		}else{
			$cl_crm->TICL='Cliente';
		}
				
		$cl_crm->TIPO_ENTIDAD='Cliente SAP';
		$cl_crm->REGIO01=$cl_crm->REGIO;
		$cl_crm->save();
	    if (!$serv->is_running()){exit;}		
	}
	saprfc_function_free($fce);
	
	unset($tabla,$value,$cl_crm,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);
	
	
/************************************************************************************
 *     A CONTINUACION SE TRATAN CLIENTES DE ARGENTINA
 * 
 ************************************************************************************/

	

	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>CLIENTES");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_CLIENT");
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
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>CLIENTES ");
	
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
		$cl_crm = new Cliente_CRM_TODO();
		$cl_crm = $cl_crm->cliente_de_UN($value[KUNNR],$value[VKORG]);
		foreach ($value as $k=>$v) {
			$cl_crm->$k=$v;
		}
		if(substr($cl_crm->KUNNR,0,6)=='000100'  ||  substr($cl_crm->KUNNR,0,6)=='000200'){
			$cl_crm->TICL='Descarga';		
		}else{
			$cl_crm->TICL='Cliente';
		}
		$cl_crm->TIPO_ENTIDAD='Cliente SAP';
		$cl_crm->REGIO01=$cl_crm->REGIO;
		$cl_crm->save();
	    if (!$serv->is_running()){exit;}		
	}
	saprfc_function_free($fce);
	
	unset($tabla,$value,$cl_crm,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);
	


/************************************************************************************
 *     A CONTINUACION SE TRATAN VENDEDORES DE PERÚ
 * 
 ************************************************************************************/
	
	

	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>VENDEDORES");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_VENDED");
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
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00002","KIND"=>"S","SIGN"=>"I","OPTION"=>"EQ","LOW"=>"ZV","HIGH"=>""));
	
	//Do RFC call of function RSAQ_REMOTE_QUERY_CALL, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>VENDEDORES ");
	
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
		$ve_crm = new Vendedor_CRM_TMP();
		foreach ($value as $k=>$v) {
			$ve_crm->$k=$v;
		}
		$ve_crm->save();
	    if (!$serv->is_running()){exit;}		
	}
	saprfc_function_free($fce);
	
	unset($tabla,$value,$cl_crm,$ve_crm,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);
		
/************************************************************************************
 *     A CONTINUACION SE TRATAN CLIENTES TRATADOS COMO DESCARGA DE PERÚ
 * 
 ************************************************************************************/

	

	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>CLIENTES");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_CLIEWE");
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
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00002","KIND"=>"S","SIGN"=>"I","OPTION"=>"EQ","LOW"=>"WE","HIGH"=>""));
	
	//Do RFC call of function RSAQ_REMOTE_QUERY_CALL, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>CLIENTES ");
	
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
		$cl_crm = new Cliente_CRM_TODO();
		$cl_crm = $cl_crm->cliente_de_UN($value[KUNNR],$value[VKORG]);
		foreach ($value as $k=>$v) {
			$cl_crm->$k=$v;
		}
		if(substr($cl_crm->KUNNR,0,6)=='000100'  ||  substr($cl_crm->KUNNR,0,6)=='000200'){
			$cl_crm->TICL='Descarga';		
		}else{
			$cl_crm->TICL='Cliente';
		}
		$cl_crm->TIPO_ENTIDAD='Cliente SAP';
		$cl_crm->REGIO01=$cl_crm->REGIO;
		$cl_crm->save();
	    if (!$serv->is_running()){exit;}		
	}
	saprfc_function_free($fce);
	
	unset($tabla,$value,$cl_crm,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);
	
	
	

/************************************************************************************
 *     A CONTINUACION SE TRATAN CLLIENTES DE PERÚ
 * 
 ************************************************************************************/

	

	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>CLIENTES");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_CLIENT");
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
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>>CLIENTES ");
	
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
		$cl_crm = new Cliente_CRM_TODO();
		$cl_crm = $cl_crm->cliente_de_UN($value[KUNNR],$value[VKORG]);
		foreach ($value as $k=>$v) {
			$cl_crm->$k=$v;
		}
		if(substr($cl_crm->KUNNR,0,6)=='000100'  ||  substr($cl_crm->KUNNR,0,6)=='000200'){
			$cl_crm->TICL='Descarga';		
		}else{
			$cl_crm->TICL='Cliente';
		}
		$cl_crm->TIPO_ENTIDAD='Cliente SAP';
		$cl_crm->REGIO01=$cl_crm->REGIO;
		$cl_crm->save();
	    if (!$serv->is_running()){exit;}		
	}
	saprfc_function_free($fce);
	
	unset($tabla,$value,$cl_crm,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);

	
	
	
/************************************************************************************
 *     A CONTINUACION SE TRATAN SQL
 * 
 ************************************************************************************/
	
	
	$sql_ok = true;  //actualizo EL ESTADO DE DEUDA DEL CLIENTE   
	$sql = "update cliente_crm_todo as c left join (select zz.bukrs,zz.kunnr,zz.vkorg,
										sum(if(RowNumber=2,zz.kunn2,'')) as kunn2,
										sum(if(RowNumber=3,zz.kunn2,'')) as kunn3,
										sum(if(RowNumber=4,zz.kunn2,'')) as kunn4,
										sum(if(RowNumber=5,zz.kunn2,'')) as kunn5,
										sum(if(RowNumber=6,zz.kunn2,'')) as kunn6 
	from (SELECT  @row_num := IF(@prev_value=CONVERT(concat_ws(';',t.bukrs,t.kunnr,t.vkorg) USING latin1) COLLATE latin1_general_ci,@row_num+1,2) AS RowNumber
         ,t.bukrs 
         ,t.kunnr
         ,t.vkorg
         ,t.kunn2
         ,@prev_value := CONVERT(concat_ws(';',t.bukrs,t.kunnr,t.vkorg) USING latin1) COLLATE latin1_general_ci
    FROM (select * from vendedor_crm_tmp group by bukrs,kunnr,vkorg,kunn2) t,
         (SELECT @row_num := 2) x,
         (SELECT @prev_value := ';') y

   ORDER BY t.bukrs,t.kunnr,t.vkorg,t.parza) as zz group by bukrs,kunnr,vkorg) as hh on hh.bukrs=c.bukrs and hh.kunnr=c.kunnr and hh.vkorg=c.vkorg 
   set 
		c.kunn2=CONVERT(if(hh.kunn2<>0,lpad(hh.kunn2,10,'0'),'') USING latin1) COLLATE latin1_general_ci,
		c.kunn3=CONVERT(if(hh.kunn3<>0,lpad(hh.kunn3,10,'0'),'') USING latin1) COLLATE latin1_general_ci,
		c.kunn4=CONVERT(if(hh.kunn4<>0,lpad(hh.kunn4,10,'0'),'') USING latin1) COLLATE latin1_general_ci,
		c.kunn5=CONVERT(if(hh.kunn5<>0,lpad(hh.kunn5,10,'0'),'') USING latin1) COLLATE latin1_general_ci,
		c.kunn6=CONVERT(if(hh.kunn6<>0,lpad(hh.kunn6,10,'0'),'') USING latin1) COLLATE latin1_general_ci";
	try {
		MyActiveRecord :: Query($sql);
	} catch (Exception $e) {
		$serv->pongo_hayError($sql."||".$e);
		$sql_ok = false;
		echo "ERROR::".$sql."||".$e."\r\n";
		die;
	}
	
?>
