<?php

	//RFC Call for ZHU_CREATE_GOODSMVT_RFCV1
	//Discover interface for function module ZHU_CREATE_GOODSMVT_RFCV1
	$fce = saprfc_function_discover($rfc,"ZHU_CREATE_GOODSMVT_RFCV1");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   ZHU_CREATE_GOODSMVT_RFCV1"  ); exit; }
	//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.

	$tarOj = new Sl_Tar();
	$tarOj = $tarOj->buscar($tarx->id);
							       //"MATNR"=>$tarea->nroMaterialSap().$tarea->nroLoteSap();
	
	//RFC Call for ZHU_CREATE_GOODSMVT_RFCV1
	//Discover interface for function module ZHU_CREATE_GOODSMVT_RFCV1
	saprfc_import ($fce,"IS_IMKPF", array ("BLDAT"=>"","BUDAT"=>"","XBLNR"=>"","BKTXT"=>"","FRBNR"=>"","XABLN"=>"","EXNUM"=>"","USNAM"=>"","VBUND"=>"","BFWMS"=>"","PR_UNAME"=>"","PR_PRINT"=>"","LIFEX"=>"","WEVER"=>"","WEVERX"=>"","BAR_CODE"=>"","SPE_BUDAT_UHR"=>"","SPE_BUDAT_ZONE"=>"","LE_VBELN"=>"","SPE_LOGSYS"=>"","SPE_MDNUM_EWM"=>"","GTS_CUSREF_NO"=>"","MSR_ACTIVE"=>""));
	saprfc_import ($fce,"IV_COMMIT","X");
	saprfc_import ($fce,"IV_EVENT","0003");
	saprfc_import ($fce,"IV_EXIDV",str_pad((int) $tarOj->nroUtSap(),20,"0",STR_PAD_LEFT));
	saprfc_import ($fce,"IV_SIMULATE","");
	saprfc_import ($fce,"IV_TCODE","HUMO");
	saprfc_import ($fce,"IS_Z_MOVE_TO", array ("HUWBEVENT"=>"","MATNR"=>"","CHARG"=>"","WERKS"=>"","LGORT"=>"","BESTQ"=>"","SOBKZ"=>"","SONUM"=>"","LGNUM"=>"","GRUND"=>"","KONTO"=>"","LIFNR"=>"","KUNNR"=>"","GSBER"=>"","KOSTL"=>"","BWART"=>""));
	//Fill internal tables
	saprfc_table_init ($fce,"ET_MESSAGES");
	saprfc_table_init ($fce,"IT_HU_ITEMS");
	
		//Do RFC call of function ZHU_CREATE_GOODSMVT_RFCV1, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$ES_EMKPF = saprfc_export ($fce,"ES_EMKPF");
	$ES_MESSAGE = saprfc_export ($fce,"ES_MESSAGE");
	$EV_POSTED = saprfc_export ($fce,"EV_POSTED");
	$rows = saprfc_table_rows ($fce,"ET_MESSAGES");
	for ($i=1;$i<=$rows;$i++)
		$ET_MESSAGES[] = saprfc_table_read ($fce,"ET_MESSAGES",$i);
	$rows = saprfc_table_rows ($fce,"IT_HU_ITEMS");
	for ($i=1;$i<=$rows;$i++)
		$IT_HU_ITEMS[] = saprfc_table_read ($fce,"IT_HU_ITEMS",$i);
	//Debug info
							
	$serv->set_subestado("procesando  ZHU_CREATE_GOODSMVT_RFCV1");
	
				
	$res = new Resultado_Ejecucion();
	$res = $res->buscarExtendido("ZHU_CREATE_GOODSMVT_RFCV1", $tarOj->nroUtSap());	
	$res->RFC="ZHU_CREATE_GOODSMVT_RFCV1";
	$res->id_objeto_sap=$tarOj->nroUtSap();
	$res->tarea = $tarOj->nmov_lt;
	if($EV_POSTED==1){
		$res->TYPE="S";
	}else{
		$res->TYPE="E";	
	}
	$cadena="";
	foreach ($ES_MESSAGE as $k=>$v) {
		$cadena=$cadena.$k."=".$v."\r\n";
	}
	$res->MESSAGE=$cadena;
	$res->MESSAGE_V1=$ES_EMKPF[MBLNR];
	$res->MESSAGE_V2=$ES_EMKPF[MJAHR];
	$res->MESSAGE_V3=$ES_EMKPF[CPUDT];
	$res->MESSAGE_V4=$ES_EMKPF[CPUTM];
	$res->save();
	
	
	saprfc_function_free($fce);
	unset($res,$ES_EMKPF,$ES_MESSAGE,$EV_POSTED)			

	
	
?>