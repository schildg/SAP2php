<?php
    if (!$serv->is_running()){exit;}		

	//Discover interface for function module RFC_READ_TABLE
	$fce = saprfc_function_discover($rfc,"RFC_READ_TABLE");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed RFC_READ_TABLE"); exit; }

	saprfc_import ($fce,"DELIMITER",";");
	saprfc_import ($fce,"NO_DATA","");
	saprfc_import ($fce,"QUERY_TABLE","T001W");
	saprfc_import ($fce,"ROWCOUNT","");
	saprfc_import ($fce,"ROWSKIPS","");
	//Fill internal tables
	saprfc_table_init ($fce,"DATA");
	saprfc_table_init ($fce,"FIELDS");
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"WERKS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"NAME1","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"BWKEY","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KUNNR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LIFNR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"FABKL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"NAME2","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"STRAS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"PFACH","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"PSTLZ","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ORT01","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"EKORG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VKORG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"CHAZV","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KKOWK","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KORDB","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"BEDPL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LAND1","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"REGIO","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"COUNC","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"CITYC","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ADRNR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"IWERK","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"TXJCD","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VTWEG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"SPART","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"SPRAS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"WKSOP","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"AWSLS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"CHAZV_OLD","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VLFKZ","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"BZIRK","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ZONE1","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"TAXIW","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"BZQHL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LET01","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LET02","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LET03","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"TXNAM_MA1","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"TXNAM_MA2","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"TXNAM_MA3","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"BETOL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"J_1BBRANCH","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VTBFI","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"FPRFW","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ACHVM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"DVSART","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"NODETYPE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"NSCHEMA","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"PKOSA","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MISCH","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MGVUPD","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VSTEL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MGVLAUPD","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MGVLAREVAL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"SOURCING","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"OILIVAL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"OIHVTYPE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"OIHCREDIPI","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"STORETYPE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"DEP_STORE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
		
	
	if (!$serv->is_running()){exit;}		
	
	saprfc_table_init ($fce,"OPTIONS");
	//Do RFC call of function RFC_READ_TABLE, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta RFC_READ_TABLE -> T001W");
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
	cargar_sql($FIELDS,$DATA,"Centro",$clave,"I",$serv);
	
    if (!$serv->is_running()){exit;}		
	
	saprfc_function_free($fce);
	unset($cad,$csv,$str,$obj,$DATA,$FIELDS);
				
			
	$reg_ult_act = new Actualizacion_CRM("Centro");
	$reg_ult_act->save();
	
	
	
	
	
?>