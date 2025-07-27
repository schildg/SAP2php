<?php
    if (!$serv->is_running()){exit;}		

	//Discover interface for function module RFC_READ_TABLE
	$fce = saprfc_function_discover($rfc,"RFC_READ_TABLE");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed RFC_READ_TABLE"); exit; }

	saprfc_import ($fce,"DELIMITER",";");
	saprfc_import ($fce,"NO_DATA","");
	saprfc_import ($fce,"QUERY_TABLE","T052");
	saprfc_import ($fce,"ROWCOUNT","");
	saprfc_import ($fce,"ROWSKIPS","");
	//Fill internal tables
	saprfc_table_init ($fce,"DATA");
	saprfc_table_init ($fce,"FIELDS");
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZTERM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZTAGG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZDART","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZFAEL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZMONA","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZTAG1","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZPRZ1","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZTAG2","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZPRZ2","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZTAG3","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZSTG1","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZSMN1","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZSTG2","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZSMN2","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZSTG3","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZSMN3","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"XZBRV","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZSCHF","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"XCHPB","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"TXN08","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZLSCH","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"XCHPM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KOART","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"XSPLT","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"XSCRC","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	
	
	if (!$serv->is_running()){exit;}		
	
	saprfc_table_init ($fce,"OPTIONS");
	//Do RFC call of function RFC_READ_TABLE, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta RFC_READ_TABLE -> T052");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"DATA");
	for ($i=1;$i<=$rows;$i++)
		$DATA[] = saprfc_table_read ($fce,"DATA",$i);
	$rows = saprfc_table_rows ($fce,"FIELDS");
	for ($i=1;$i<=$rows;$i++)
		$FIELDS[] = saprfc_table_read ($fce,"FIELDS",$i);
	$rows = saprfc_table_rows ($fce,"OPTIONS");
	for ($i=1;$i<=$rows;$i++)
		$OPTIONS[] = saprfc_table_read ($fce,"OPTIONS",$i);
	//Debug info
		
	$clave=array();
	cargar_sql($FIELDS,$DATA,"Condicion_Pago",$clave,"I",$serv);
	
    if (!$serv->is_running()){exit;}		
	
	saprfc_function_free($fce);
	unset($cad,$csv,$str,$obj,$DATA,$FIELDS);
				
			
	
	
    if (!$serv->is_running()){exit;}		

	//Discover interface for function module RFC_READ_TABLE
	$fce = saprfc_function_discover($rfc,"RFC_READ_TABLE");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed RFC_READ_TABLE"); exit; }

	saprfc_import ($fce,"DELIMITER",";");
	saprfc_import ($fce,"NO_DATA","");
	saprfc_import ($fce,"QUERY_TABLE","T052U");
	saprfc_import ($fce,"ROWCOUNT","");
	saprfc_import ($fce,"ROWSKIPS","");
	//Fill internal tables
	saprfc_table_init ($fce,"DATA");
	saprfc_table_init ($fce,"FIELDS");
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZTERM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZTAGG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"TEXT1","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	
	if (!$serv->is_running()){exit;}		
	
	saprfc_table_init ($fce,"OPTIONS");
	saprfc_table_append ($fce,"OPTIONS", array ("TEXT"=>"SPRAS EQ `S`"));
	//Do RFC call of function RFC_READ_TABLE, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta RFC_READ_TABLE -> T052U");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"DATA");
	for ($i=1;$i<=$rows;$i++)
		$DATA[] = saprfc_table_read ($fce,"DATA",$i);
	$rows = saprfc_table_rows ($fce,"FIELDS");
	for ($i=1;$i<=$rows;$i++)
		$FIELDS[] = saprfc_table_read ($fce,"FIELDS",$i);
	$rows = saprfc_table_rows ($fce,"OPTIONS");
	for ($i=1;$i<=$rows;$i++)
		$OPTIONS[] = saprfc_table_read ($fce,"OPTIONS",$i);
	//Debug info
		
	$clave=array("ZTERM","ZTAGG");
	cargar_sql($FIELDS,$DATA,"condicion_pago",$clave,"U",$serv);
	
    if (!$serv->is_running()){exit;}		
	
	saprfc_function_free($fce);
	unset($cad,$csv,$str,$obj,$DATA,$FIELDS);
				
	$reg_ult_act = new Actualizacion_CRM("Condicion_Pago");
	$reg_ult_act->save();
	
	
	
	
	
?>