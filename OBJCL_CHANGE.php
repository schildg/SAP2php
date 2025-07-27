<?php

	//RFC Call for BAPI_OBJCL_CHANGE
	//Discover interface for function module BAPI_OBJCL_CHANGE
	$fce = saprfc_function_discover($rfc,"BAPI_OBJCL_CHANGE");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   BAPI_OBJCL_CHANGE"  ); exit; }
	//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.

	$timestamphoy = mktime(0, 0, 0,  date("m"), date("d"), date("Y"));
	$fecha_hoy    =  date("Ymd",$timestamphoy);
	
	$tarOj = new Sl_Tar();
	$tarOj = $tarOj->buscar($tarx->id);
							       //"MATNR"=>$tarea->nroMaterialSap().$tarea->nroLoteSap();
	
	//RFC Call for BAPI_OBJCL_CHANGE
	//Discover interface for function module BAPI_OBJCL_CHANGE
	saprfc_import ($fce,"CHANGENUMBER","");
	saprfc_import ($fce,"CLASSNUM","LOT_VARIOS_ARG_V1");
	saprfc_import ($fce,"CLASSTYPE","023");
	saprfc_import ($fce,"KEYDATE",$fecha_hoy);
	saprfc_import ($fce,"NO_DEFAULT_VALUES","");
	saprfc_import ($fce,"OBJECTKEY",$tarOj->nroMaterialSap().$tarOj->nroLoteSap());
	saprfc_import ($fce,"OBJECTTABLE","MCH1");
	saprfc_import ($fce,"STANDARDCLASS","");
	saprfc_import ($fce,"STATUS","1");
	//Fill internal tables
	saprfc_table_init ($fce,"ALLOCVALUESCHARNEW");
	saprfc_table_append ($fce,"ALLOCVALUESCHARNEW", array ("CHARACT"=>"LOT_NRO_DESPACHO","VALUE_CHAR"=>".","INHERITED"=>"","INSTANCE"=>"","VALUE_NEUTRAL"=>"","CHARACT_DESCR"=>""));
	saprfc_table_init ($fce,"ALLOCVALUESCURRNEW");
	saprfc_table_init ($fce,"ALLOCVALUESNUMNEW");
	saprfc_table_init ($fce,"RETURN");
	//Do RFC call of function BAPI_OBJCL_CHANGE, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$CLASSIF_STATUS = saprfc_export ($fce,"CLASSIF_STATUS");
	$rows = saprfc_table_rows ($fce,"ALLOCVALUESCHARNEW");
	for ($i=1;$i<=$rows;$i++)
		$ALLOCVALUESCHARNEW[] = saprfc_table_read ($fce,"ALLOCVALUESCHARNEW",$i);
	$rows = saprfc_table_rows ($fce,"ALLOCVALUESCURRNEW");
	for ($i=1;$i<=$rows;$i++)
		$ALLOCVALUESCURRNEW[] = saprfc_table_read ($fce,"ALLOCVALUESCURRNEW",$i);
	$rows = saprfc_table_rows ($fce,"ALLOCVALUESNUMNEW");
	for ($i=1;$i<=$rows;$i++)
		$ALLOCVALUESNUMNEW[] = saprfc_table_read ($fce,"ALLOCVALUESNUMNEW",$i);
	$rows = saprfc_table_rows ($fce,"RETURN");
	for ($i=1;$i<=$rows;$i++)
		$RETURN[] = saprfc_table_read ($fce,"RETURN",$i);
					
	$serv->set_subestado("procesando  BAPI_OBJCL_CHANGE");
	
				
	$i_ret=0;
	foreach($RETURN as $retu){
		if(!($retu[TYPE]=="" && $retu[NUMBER]==0)){
			$i_ret=$i_ret+1;
			$res = new Resultado_Ejecucion();
			$res = $res->buscarExtendido("BAPI_OBJCL_CHANGE", $tarOj->nroLoteSap()."-".$i_ret);	
			$res->RFC="BAPI_OBJCL_CHANGE";
			$res->id_objeto_sap=$tarOj->nroLoteSap()."-".$i_ret;
			$res->tarea = $tarOj->nmov_lt;
			foreach ($retu as $k => $v){
				if ($k=="ID"){
				   $res->ID_SAP = $v;
				}else{
					$res->$k = $v;
				}
			};
			$res->save();
		}
	}
	saprfc_function_free($fce);
				


	//RFC Call for BAPI_TRANSACTION_COMMIT
	//Discover interface for function module BAPI_TRANSACTION_COMMIT
	$fce = saprfc_function_discover($rfc,"BAPI_TRANSACTION_COMMIT");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   BAPI_TRANSACTION_COMMIT"  ); exit; }
	$serv->set_subestado("procesando BAPI_TRANSACTION_COMMIT");
	
	saprfc_import ($fce,"WAIT","1");
	
	//Do RFC call of function BAPI_TRANSACTION_COMMIT, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	
					

	$RETURN = saprfc_export ($fce,"RETURN");
	$res = new Resultado_Ejecucion();
	$res = $res->buscarExtendido("BAPI_TRANSACTION_COMMIT", $tarOj->nroLoteSap());	
	$res->RFC="BAPI_TRANSACTION_COMMIT";
	$res->id_objeto_sap=$tarOj->nroLoteSap();			
	foreach ($RETURN as $k => $v){
		if ($k=="ID"){
		   $res->ID_SAP = $v;
		}else{
			$res->$k = $v;
		}
	};
	$res->save();
	saprfc_function_free($fce);	
	
	
	
?>