<?php
    if (!$serv->is_running()){exit;}		

	//Discover interface for function module RFC_READ_TABLE
	$fce = saprfc_function_discover($rfc,"RFC_READ_TABLE");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed RFC_READ_TABLE"); exit; }

	saprfc_import ($fce,"DELIMITER",";");
	saprfc_import ($fce,"NO_DATA","");
	saprfc_import ($fce,"QUERY_TABLE","T001L");
	saprfc_import ($fce,"ROWCOUNT","");
	saprfc_import ($fce,"ROWSKIPS","");
	//Fill internal tables
	saprfc_table_init ($fce,"DATA");
	saprfc_table_init ($fce,"FIELDS");
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"WERKS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LGORT","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LGOBE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"SPART","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"XLONG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"XBUFX","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"DISKZ","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"XBLGO","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"XRESS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"XHUPF","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"PARLG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VKORG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VTWEG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VSTEL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LIFNR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KUNNR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MESBS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MESST","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"OIH_LICNO","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"OIG_ITRFL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"OIB_TNKASSIGN","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	
	
	if (!$serv->is_running()){exit;}		
	
	saprfc_table_init ($fce,"OPTIONS");
	//Do RFC call of function RFC_READ_TABLE, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta RFC_READ_TABLE -> T001L");
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
	cargar_sql($FIELDS,$DATA,"Almacen",$clave,"I",$serv);
	
    if (!$serv->is_running()){exit;}		
	
	saprfc_function_free($fce);
	unset($cad,$csv,$str,$obj,$DATA,$FIELDS);
				
			
	$reg_ult_act = new Actualizacion_CRM("Almacen");
	$reg_ult_act->save();
	
	
	
	
	
	
?>