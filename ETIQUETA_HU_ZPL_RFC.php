<?php





$pendiente = new Pendiente_Tratar();		

$lista_pendientes = $pendiente->todos("Px_Pfp","IMP");
$serv->set_subestado("iniciando proceso de Z_WM_ETIQUETA_HU_ZPL_RFC");
if ($lista_pendientes){
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auno_lq!="" and $pend->impreso==false){
				$ns_rel = New Ns_Rel();
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$OF = new OrdenProduccion();
				$OF = $OF->buscarExtendido($numero_OF);
				$Op = New Posicion();
				$Op = $Op->buscarExtendido($numero_OF, 1);
				$st_doc =  new St_Doc();
				$st_doc = $st_doc->buscarDOC($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				$str_fecha= str_replace("-","",$st_doc->fech_sd);
				$st_lot =  new St_Lot();
				$st_lot = $st_lot->buscarLote($px_pfp->lotc_lq,$px_pfp->lotn_lq);
				
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
						$ut_hu = new Ut_Hu();
						$ut_hu = $ut_hu->buscoTarea($tarea->nmov_lt);
						if ($tarea->declarado_en_sap=="Notificada"){
							$mat = new Material();
							$mat = $mat->buscarExtendido($tarea->nroMaterialSap());
						    if (!$serv->is_running()){exit;}		
							
							//RFC Call for Z_WM_ETIQUETA_HU_ZPL_RFC
							//Discover interface for function module Z_WM_ETIQUETA_HU_ZPL_RFC
							$fce = saprfc_function_discover($rfc,"Z_WM_ETIQUETA_HU_ZPL_RFC");
							if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   Z_WM_ETIQUETA_HU_ZPL_RFC"  ); exit; }
							$serv->set_subestado("procesando Z_WM_ETIQUETA_HU_ZPL_RFC");
							
							//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.
							
							saprfc_import ($fce,"IV_CHARG",$st_lot->lotc_sl.$st_lot->lotn_sl);
							saprfc_import ($fce,"IV_EXIDV",$ut_hu->EXIDV_OB);
							saprfc_import ($fce,"IV_LDEST","AE36");
							saprfc_import ($fce,"IV_LGORT",$Op->STORAGE_LOCATION);
							saprfc_import ($fce,"IV_LOT_BATCH",$OF->BATCH);
							saprfc_import ($fce,"IV_MATNR",$mat->MATNR);
							saprfc_import ($fce,"IV_VEMEH",$mat->MEINS);
							saprfc_import ($fce,"IV_VEMNG",$tarea->cant_lt);
							saprfc_import ($fce,"IV_WERKS",$OF->PRODUCTION_PLANT);
							//Fill internal tables
							saprfc_table_init ($fce,"RETURN");
							
							//Do RFC call of function Z_WM_ETIQUETA_HU_ZPL_RFC, for handling exceptions use saprfc_exception()
							$rfc_rc = saprfc_call_and_receive ($fce);
							if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
							//Retrieve export parameters
							$rows = saprfc_table_rows ($fce,"RETURN");
							for ($i=1;$i<=$rows;$i++)
								$RETURN[] = saprfc_table_read ($fce,"RETURN",$i);
							
							//Debug info
							
							$res = new Resultado_Ejecucion();
							$res = $res->buscarExtendido("Z_WM_ETIQUETA_HU_ZPL_RFC", $numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt);	
							$res->RFC="Z_WM_ETIQUETA_HU_ZPL_RFC";
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
								$tarea->declarado_en_sap="Impresa";
								$tarea->save();
							}	
							saprfc_function_free($fce);
						}
						$cant_lineas = $cant_lineas - 1;	
					}
					$tiene_tareas_pendientes = false;
					foreach ($sl_tar_lista as $tarx){
						$tarea = new Sl_Tar();
						$tarea = $tarea->buscar($tarx->id);
						if ($tarea->declarado_en_sap=="Notificada"){
							$tiene_tareas_pendientes=true;
						}	
					}
					if(!$tiene_tareas_pendientes){
						$pend->estado="MOV";
						$pend->impreso=true;
						$pend->save();
					}else{
						$pend->estado="IMx";
						$pend->save();
						
					}
				}	
			}else{
				if ($pend->impreso){
					$pend->estado="MOV";
					$pend->save();
				}
				
			}
		}
	}
}


unset($pendiente,$sql_ok,$sql,$lista_pendientes,$px_pfp,$ns_rel,$numero_OF,$OF,$Op,$st_doc,$str_fecha,$sl_tar,$sl_tar_lista,$tarea,$cant_lineas,$mat,$fce,$out,$rfc_rc,$RETURN,$res,$nro_HU_SAP,$ut_hu,$tiene_tareas_pendientes,$lista_ord_fab,$material,$file_paquete,$st_lot);
	
?>