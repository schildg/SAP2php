<?php

		$sql_ok = true; 
		$sql = "UPDATE pendiente_tratar SET estado='MOV' WHERE estado='MOx' ";       //SI EN UN FUTURO ARREGLAN EL ERROR DE INGRESOS EN SAP SE DEBE QUITAR ESTE SQL
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			$sql_ok = false;
		}


$pendiente = new Pendiente_Tratar();	
$lista_pendientes = $pendiente->todos("Px_Pfp","MOV");
$serv->set_subestado("iniciando proceso de ZHU_CREATE_GOODSMVT_RFCV1");
if ($lista_pendientes){
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auno_lq!="" and $pend->traspaso==false){
				$ns_rel = New Ns_Rel();
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$OF = new OrdenProduccion();
				$OF = $OF->buscarExtendido($numero_OF);
				$Op = New Posicion();
				$Op = $Op->buscarExtendido($numero_OF, 1);
				$st_doc =  new St_Doc();
				$st_doc = $st_doc->buscarDOC($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				$str_fecha= str_replace("-","",$st_doc->fech_sd);
	/*			$str_anio=substr($str_fecha,0,4);
				$str_mes=substr($str_fecha,4,2);
				$str_dia=substr($str_fecha,6,2);
				$str_fecha=$str_anio.$str_mes.$str_dia;*/
				
				$sl_tar =  new Sl_Tar();
				$sl_tar_lista = $sl_tar->tareasDeEntrada($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				if ($sl_tar_lista){
	
					$tarea = new Sl_Tar();
					
					$cant_lineas = count($sl_tar_lista);
					$cant_lineas = $cant_lineas - 1;
	
					foreach ($sl_tar_lista as $tarx){
						$tarea = new Sl_Tar();
						$tarea = $tarea->buscar($tarx->id);
						if ($tarea->declarado_en_sap=="Impresa"){
							$mat = new Material();
							$ut_Hu=new Ut_Hu();
							$ut_Hu=$ut_Hu->buscoTarea($tarea->nmov_lt);
						
							//RFC Call for ZHU_CREATE_GOODSMVT_RFCV1
							//Discover interface for function module ZHU_CREATE_GOODSMVT_RFCV1
							$fce = saprfc_function_discover($rfc,"ZHU_CREATE_GOODSMVT_RFCV1");
							if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   ZHU_CREATE_GOODSMVT_RFCV1"  ); exit; }
							//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.
						
													       //"MATNR"=>$tarea->nroMaterialSap().$tarea->nroLoteSap();
							
							//RFC Call for ZHU_CREATE_GOODSMVT_RFCV1
							//Discover interface for function module ZHU_CREATE_GOODSMVT_RFCV1
							saprfc_import ($fce,"IS_IMKPF", array ("BLDAT"=>"","BUDAT"=>"","XBLNR"=>"","BKTXT"=>"","FRBNR"=>"","XABLN"=>"","EXNUM"=>"","USNAM"=>"","VBUND"=>"","BFWMS"=>"","PR_UNAME"=>"","PR_PRINT"=>"","LIFEX"=>"","WEVER"=>"","WEVERX"=>"","BAR_CODE"=>"","SPE_BUDAT_UHR"=>"","SPE_BUDAT_ZONE"=>"","LE_VBELN"=>"","SPE_LOGSYS"=>"","SPE_MDNUM_EWM"=>"","GTS_CUSREF_NO"=>"","MSR_ACTIVE"=>""));
							saprfc_import ($fce,"IV_COMMIT","X");
							saprfc_import ($fce,"IV_EVENT","0006");
							saprfc_import ($fce,"IV_EXIDV",$ut_Hu->EXIDV_OB);
							saprfc_import ($fce,"IV_SIMULATE","");
							saprfc_import ($fce,"IV_TCODE","HUMO");
							saprfc_import ($fce,"IS_Z_MOVE_TO", array ("HUWBEVENT"=>"","MATNR"=>"","CHARG"=>"","WERKS"=>"","LGORT"=>"ACFE","BESTQ"=>"","SOBKZ"=>"","SONUM"=>"","LGNUM"=>"","GRUND"=>"","KONTO"=>"","LIFNR"=>"","KUNNR"=>"","GSBER"=>"","KOSTL"=>"","BWART"=>""));
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
							$res = $res->buscarExtendido("ZHU_CREATE_GOODSMVT_RFCV1", $numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt);	
							$res->RFC="ZHU_CREATE_GOODSMVT_RFCV1";
							$res->id_objeto_sap=$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt;
							$res->tarea = $tarea->nmov_lt;
							if($EV_POSTED==1){
								$res->TYPE="S";
							}else{
								$res->TYPE="E";	
							}
							echo "---------------------------\r\n";
							echo "ut->".$tarea->utor_lt;
							echo "IV_EXIDV=".$ut_Hu->EXIDV_OB."\r\n";
							$cadena="";
							echo "ES_MESSAGE de ".$numero_OF."\r\n";
							foreach ($ES_MESSAGE as $k=>$v) {
								echo $k."=".$v."\r\n";
								$cadena=$cadena.$k."=".$v."\r\n";
							}
							echo "IS_Z_MOVE_TO de ".$numero_OF."\r\n";
							foreach ($IS_Z_MOVE_TO as $k=>$v) {
								echo $k."=".$v."\r\n";
							}
							
							echo "ES_EMKPF de ".$numero_OF."\r\n";
							foreach ($ES_EMKPF as $k=>$v) {
								echo $k."=".$v."\r\n";
							}
							echo "ET_MESSAGE de ".$numero_OF."\r\n";
							foreach ($ET_MESSAGES as $k=>$v) {
								echo $k."=".$v."\r\n";
							}
							
							$res->MESSAGE=$cadena;
							$res->MESSAGE_V1=$ES_EMKPF[MBLNR];
							$res->MESSAGE_V2=$ES_EMKPF[MJAHR];
							$res->MESSAGE_V3=$ES_EMKPF[CPUDT];
							$res->MESSAGE_V4=$ES_EMKPF[CPUTM];
							$res->save();
	
							if($EV_POSTED==1){
								$nro_HU_SAP = $res->MESSAGE_V2;
								$tarea->declarado_en_sap="Traspasado";
								$tarea->save();
								$at_mov = new At_Mov();
								$at_mov->cmov_lu="UT";
								$at_mov->nmov_lu=$tarea->utor_lt;
								$at_mov->cmov_sd=$st_doc->cmov_sd;
								$at_mov->nmov_sd=$st_doc->nmov_sd;
								$at_mov->tarea = $tarea->nmov_lt;
								$at_mov->cant_lt = $tarea->cant_lt;
								$at_mov->AUFNR=$numero_OF;
								$at_mov->MBLNR=$ES_EMKPF[MBLNR];
								$at_mov->MJAHR=$ES_EMKPF[MJAHR];
								$at_mov->estado="PEN";
								$at_mov->save();
//							}else{
//								$serv->pongo_hayError("SAP informo un Error:: TYPE ".$res->TYPE." ::NUMBER ".$res->NUMBER." ::MESSAGE ".$res->MESSAGE);
//								exit;
							}	
							saprfc_function_free($fce);
						}
						$cant_lineas = $cant_lineas - 1;	
					}
					$tiene_tareas_pendientes = false;
					foreach ($sl_tar_lista as $tarx){
						$tarea = new Sl_Tar();
						$tarea = $tarea->buscar($tarx->id);
						if ($tarea->declarado_en_sap=="Impresa"){
							$tiene_tareas_pendientes=true;
						}	
					}
					if(!$tiene_tareas_pendientes){
						$pend->estado="PAR";
						$pend->traspaso=true;
						$pend->save();
					}else{
						$pend->estado="MOx";
						$pend->save();
						
					}
				}	
			}else{
				if ($pend->traspaso){
					$pend->estado="PAR";
					$pend->save();
				}
				
			}
		}
	}
}


unset($pendiente,$sql_ok,$sql,$lista_pendientes,$px_pfp,$ns_rel,$numero_OF,$OF,$Op,$st_doc,$str_fecha,$sl_tar,$sl_tar_lista,$tarea,$cant_lineas,$mat,$fce,$out,$rfc_rc,$RETURN,$res,$nro_HU_SAP,$ut_hu,$tiene_tareas_pendientes,$lista_ord_fab,$material,$file_paquete,$ET_MESSAGES,$IT_HU_ITEMS);
	
	
?>