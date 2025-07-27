<?php
    if (!$serv->is_running()){exit;}		

	//Discover interface for function module RFC_READ_TABLE
	$fce = saprfc_function_discover($rfc,"RFC_READ_TABLE");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed RFC_READ_TABLE"); exit; }

	saprfc_import ($fce,"DELIMITER",";");
	saprfc_import ($fce,"NO_DATA","");
	saprfc_import ($fce,"QUERY_TABLE","T023T");
	saprfc_import ($fce,"ROWCOUNT","");
	saprfc_import ($fce,"ROWSKIPS","");
	//Fill internal tables
	saprfc_table_init ($fce,"DATA");
	saprfc_table_init ($fce,"FIELDS");
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"SPRAS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MATKL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"WGBEZ","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"WGBEZ60","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	
	
	if (!$serv->is_running()){exit;}		
	
	saprfc_table_init ($fce,"OPTIONS");
	saprfc_table_append ($fce,"OPTIONS", array ("TEXT"=>"SPRAS EQ `S`"));
		//Do RFC call of function RFC_READ_TABLE, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta RFC_READ_TABLE -> T023T");
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
	cargar_sql($FIELDS,$DATA,"Grupo_Articulo",$clave,"I",$serv);
	
	
    if (!$serv->is_running()){exit;}		
	
	saprfc_function_free($fce);
	unset($cad,$csv,$str,$obj,$DATA,$FIELDS);
				
	$reg_ult_act = new Actualizacion_CRM("Grupo_Articulo");
	$reg_ult_act->save();
	
	
	
	
	
?>