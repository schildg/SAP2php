<?php





$pendiente = new Pendiente_Tratar();		

		$sql_ok = true; 
		$sql = "UPDATE pendiente_tratar SET estado='PIN' WHERE estado='PIx' ";       //SI EN UN FUTURO ARREGLAN EL ERROR DE INGRESOS EN SAP SE DEBE QUITAR ESTE SQL
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			$sql_ok = false;
		}

$lista_pendientes = $pendiente->todos("Px_Pfp","PIN");
$serv->set_subestado("iniciando proceso de ZRFCPP_EMHU_ORDFAB");
if ($lista_pendientes){
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auno_lq!="" and $pend->ingreso==false){
				$ns_rel = New Ns_Rel();
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$serv->set_subestado("iniciando proceso de ZRFCPP_EMHU_ORDFAB $px_pfp->nmov_lq");
				$OF = new OrdenProduccion();
				$OF = $OF->buscarExtendido($numero_OF);
				$Op = New Posicion();
				$Op = $Op->buscarExtendido($numero_OF, 1);
				$st_doc =  new St_Doc();
				$st_doc = $st_doc->buscarDOC($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				$str_fecha= str_replace("-","",$st_doc->fech_sd);
				echo $str_fecha."\n\r";
	/*			$str_anio=substr($str_fecha,0,4);
				$str_mes=substr($str_fecha,4,2);
				$str_dia=substr($str_fecha,6,2);
				$str_fecha=$str_anio.$str_mes.$str_dia;*/
				
				$sl_tar =  new Sl_Tar();
				echo "Tareas de Entrada ".$px_pfp->cdoc_lq." - ".$px_pfp->ndoc_lq."\n\r";
				$serv->set_subestado("ZRFCPP_EMHU_ORDFAB Tareas de Entrada $px_pfp->cdoc_lq $px_pfp->ndoc_lq");
				$sl_tar_lista = $sl_tar->tareasDeEntrada($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				if ($sl_tar_lista){
	
					$tarea = new Sl_Tar();
					
					$cant_lineas = count($sl_tar_lista);
					$cant_lineas = $cant_lineas - 1;
     				echo "Cantidad de Tareas ".$px_pfp->cdoc_lq." - ".$px_pfp->ndoc_lq.$cant_lineas."\n\r";
					$serv->set_subestado("ZRFCPP_EMHU_ORDFAB Tareas de Entrada $px_pfp->ndoc_lq $cant_lineas");

	
					foreach ($sl_tar_lista as $tarx){
						$tarea = new Sl_Tar();
						echo "Buscar tarea ".$tarx->cmov_lt." - ".$tarx->nmov_lt."\n\r";

						$tarea = $tarea->buscar($tarx->id);
						if ($tarea->declarado_en_sap==""){
							$serv->set_subestado("iniciando proceso de ZRFCPP_EMHU_ORDFAB $px_pfp->nmov_lq $tarea->nmov_lt $tarea->utor_lt");
							$mat = new Material();
							echo "UTs".$tarea->utor_lt." - ".$tarea->cmov_lt.$tarea->nmov_lt;
							echo ">>>".$tarea->nroMaterialSap()."<<<";
							$nroMataSAP = $tarea->nroMaterialSap();
							echo ">>>vivo<<<";
							$mat = $mat->buscarExtendido($nroMataSAP);
							echo ">>>VIVO<<<".$mat->MATNR;
						    if (!$serv->is_running()){exit;}		
							echo ">>>ooooooooO<<<";
							//RFC Call for ZRFCPP_EMHU_ORDFAB
							//Discover interface for function module ZRFCPP_EMHU_ORDFAB
							$fce = saprfc_function_discover($rfc,"ZRFCPP_EMHU_ORDFAB");
							if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   ZRFCPP_EMHU_ORDFAB"  ); exit; }
							$serv->set_subestado("procesando ZRFCPP_EMHU_ORDFAB");
							
							//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.
							$out = new Out_EmHu_OrdFab();
							$out = $out->buscarExtendido($numero_OF, $tarea->nmov_lt);
							
							$out->AUFNR = $numero_OF;
							saprfc_import ($fce,"AUFNR",$numero_OF);
							
							$out->BUDAT=$str_fecha;
							saprfc_import ($fce,"BUDAT",$str_fecha);
							
							if ($cant_lineas==0){
								$out->ELIKZ="X";
								saprfc_import ($fce,"ELIKZ","X");
							}else{
								$out->ELIKZ="";
								saprfc_import ($fce,"ELIKZ","");
							}
							
							$out->MATNRHU="P.STD";
							saprfc_import ($fce,"MATNRHU","P.STD");
							
							$out->MEINS=$mat->MEINS;
							saprfc_import ($fce,"MEINS",$mat->MEINS);
							
							$out->QUANTITY=$tarea->cant_lt;
							saprfc_import ($fce,"QUANTITY",$tarea->cant_lt);
		
							$out->tarea=$tarea->nmov_lt;
							$out->save();
							
						
							//Do RFC call of function ZRFCPP_EMHU_ORDFAB, for handling exceptions use saprfc_exception()
							$rfc_rc = saprfc_call_and_receive ($fce);
							if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
							//Retrieve export parameters
							$RETURN = saprfc_export ($fce,"RETURN");
			
							//Debug info
							
							$res = new Resultado_Ejecucion();
							$res = $res->buscarExtendido("ZRFCPP_EMHU_ORDFAB", $numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt);	
							$res->RFC="ZRFCPP_EMHU_ORDFAB";
							$res->id_objeto_sap=$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt;		
							$res->tarea = $tarea->nmov_lt;
							foreach ($RETURN as $k => $v){
								if ($k=="ID"){
								   $res->ID_SAP = $v;
								}else{
									$res->$k = $v;
								}
							};
							$res->save();
							if($res->TYPE=="" && $res->ID_SAP==0){
								$nro_HU_SAP = $res->MESSAGE_V2;
								$tarea->declarado_en_sap="Notificada";
								$tarea->save();
								$ut_hu = new Ut_Hu();
								$ut_hu = $ut_hu->buscoUT("UT",$tarea->utor_lt);
								$ut_hu->cmov_lu="UT";
								$ut_hu->tarea = $tarea->nmov_lt;
								$ut_hu->nmov_lu=$tarea->utor_lt;
								$ut_hu->AUFNR=$numero_OF;
								$ut_hu->EXIDV_OB=$nro_HU_SAP;
								$ut_hu->estado="PEN";
								$ut_hu->save();
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
						if ($tarea->declarado_en_sap==""){
							$tiene_tareas_pendientes=true;
						}	
					}
					if(!$tiene_tareas_pendientes){
						$pend->estado="IMP";
						$pend->ingreso=true;
						$pend->save();
					}else{
						$pend->estado="PIx";
						$pend->save();
						
					}
				}	
			}else{
				if ($pend->ingreso){
					$pend->estado="IMP";
					$pend->save();
				}
				
			}
		}
	}
}


unset($pendiente,$sql_ok,$sql,$lista_pendientes,$px_pfp,$ns_rel,$numero_OF,$OF,$Op,$st_doc,$str_fecha,$sl_tar,$sl_tar_lista,$tarea,$cant_lineas,$mat,$fce,$out,$rfc_rc,$RETURN,$res,$nro_HU_SAP,$ut_hu,$tiene_tareas_pendientes,$lista_ord_fab,$material,$file_paquete);
	
?>