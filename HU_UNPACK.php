<?php

	$tarOj = new Sl_Tar();
	$tarOj = $tarOj->buscar($tarx->id);


	$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL");
	
	saprfc_import ($fce,"DATA_TO_MEMORY","X");
	saprfc_import ($fce,"DBACC","0");
	saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
	saprfc_import ($fce,"QUERY","QUE_RFC_VEPO");
	saprfc_import ($fce,"SKIP_SELSCREEN","X");
	saprfc_import ($fce,"USERGROUP","RFC_USERS");
	saprfc_import ($fce,"VARIANT","");
	saprfc_import ($fce,"WORKSPACE","");
	//Fill internal tables
	saprfc_table_init ($fce,"FPAIRS");
	saprfc_table_init ($fce,"LDATA");
	saprfc_table_init ($fce,"LISTDESC");
	saprfc_table_init ($fce,"SELECTION_TABLE");
	saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00001","KIND"=>"S","SIGN"=>"I","OPTION"=>"EQ","LOW"=>str_pad((int) $tarOj->nroUtSap(),20,"0",STR_PAD_LEFT),"HIGH"=>""));
	
	//Do RFC call of function RSAQ_REMOTE_QUERY_CALL, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>> ".str_pad((int) $tarOj->nroUtSap(),20,"0",STR_PAD_LEFT));
	
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
		if($value[EXIDV]!=''){
			$numero_de_HU_EXIDV=$value[EXIDV];
			$numero_de_HU_VELIN=$value[VELIN];
			$numero_de_HU_VEPOS=$value[VEPOS];
			$numero_de_HU_EXIDV001=$value[EXIDV001];
			if (!$serv->is_running()){exit;}
		}		
	}
	
	
	saprfc_function_free($fce);
	unset($tabla,$value,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE);








/*****************************************************************************************************
 * 
 * 
 * 
 * 
 * 
 *****************************************************************************************************/



	//RFC Call for BAPI_HU_UNPACK
	//Discover interface for function module BAPI_HU_UNPACK
	$fce = saprfc_function_discover($rfc,"BAPI_HU_UNPACK");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   BAPI_HU_UNPACK"  ); exit; }
	//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.


	saprfc_import ($fce,"HUKEY",$numero_de_HU_EXIDV001);
	saprfc_import ($fce,"ITEMUNPACK", array ("HU_ITEM_TYPE"=>$numero_de_HU_VELIN,"HU_ITEM_NUMBER"=>$numero_de_HU_VEPOS,"UNPACK_EXID"=>$numero_de_HU_EXIDV,"MATERIAL"=>"","BATCH"=>"","PACK_QTY"=>"","BASE_UNIT_QTY_ISO"=>"","BASE_UNIT_QTY"=>"","PLANT"=>"","STGE_LOC"=>"","STOCK_CAT"=>"","SPEC_STOCK"=>"","SP_STCK_NO"=>"","MATERIAL_EXTERNAL"=>"","MATERIAL_GUID"=>"","MATERIAL_VERSION"=>""));
	//Fill internal tables
	saprfc_table_init ($fce,"RETURN");
	saprfc_table_init ($fce,"SERIALNUMBERS");
	//Do RFC call of function BAPI_HU_UNPACK, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$serv->set_subestado("procesando  BAPI_HU_UNPACK");
	$HUHEADER = saprfc_export ($fce,"HUHEADER");
	$rows = saprfc_table_rows ($fce,"RETURN");
	for ($i=1;$i<=$rows;$i++)
		$RETURN[] = saprfc_table_read ($fce,"RETURN",$i);
	$rows = saprfc_table_rows ($fce,"SERIALNUMBERS");
	for ($i=1;$i<=$rows;$i++)
		$SERIALNUMBERS[] = saprfc_table_read ($fce,"SERIALNUMBERS",$i);
	//Debug info
							
	if(isset($RETURN)){
		$res = new Resultado_Ejecucion();
		$res = $res->buscarExtendido("BAPI_HU_UNPACK",str_pad((int) $tarOj->nroUtSap(),20,"0",STR_PAD_LEFT)."_1");	
		$res->RFC="BAPI_HU_UNPACK";
		$res->id_objeto_sap=str_pad((int) $tarOj->nroUtSap(),20,"0",STR_PAD_LEFT)."_1";			
		$res->tarea = $tarOj->nmov_lt;
		$res->save();  	
	}else{
		foreach($RETURN as $retu){
			if(!($retu[TYPE]=="" && $retu[NUMBER]==0)){
				$i_ret=$i_ret+1;
				$res = new Resultado_Ejecucion();
				$res = $res->buscarExtendido("BAPI_HU_UNPACK",str_pad((int) $tarOj->nroUtSap(),20,"0",STR_PAD_LEFT)."_".$i_ret);	
				$res->RFC="BAPI_HU_UNPACK";
				$res->id_objeto_sap=str_pad((int) $tarOj->nroUtSap(),20,"0",STR_PAD_LEFT)."_".$i_ret;			
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
	}
		
	saprfc_function_free($fce);
	unset($RETURN,$retu,$res,$HUHEADER,$SERIALNUMBERS);
	
	
	
	

/*****************************************************************************************************
 * 
 * 
 * 
 * 
 * 
 *****************************************************************************************************/


	
	
	
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
	$res = $res->buscarExtendido("BAPI_TRANSACTION_COMMIT", str_pad((int) $tarOj->nroUtSap(),20,"0",STR_PAD_LEFT));	
	$res->RFC="BAPI_TRANSACTION_COMMIT";
	$res->id_objeto_sap=str_pad((int) $tarOj->nroUtSap(),20,"0",STR_PAD_LEFT);			
	$res->tarea = $tarOj->nmov_lt;
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