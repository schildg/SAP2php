<?php




		$sql_ok = true; 
		$sql = "UPDATE pendiente_tratar SET estado='CSM' WHERE estado='CSs' ";       //trato todas las ordenes pendientes de tratar por haber quedado en pausa
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			$sql_ok = false;
		}



$pendiente = new Pendiente_Tratar();
$xres= new Resultado_Ejecucion();
//$lista_pendientes = $pendiente->todos("Px_Pfp","CSM");
$lista_pendientes = $pendiente->todosCSM("Px_Pfp","CSM");
if ($lista_pendientes){
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
//			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auno_lq!="" and $pend->consumo==false){
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auco_lq!="" and $pend->consumo==false){
				$ns_rel = New Ns_Rel();
				$serv->set_subestado("Busco Orden de Produccion $px_pfp->cmov_lq $px_pfp->nmov_lq");
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$OF = new OrdenProduccion();
				$OF = $OF->buscarExtendido($numero_OF);
				$Op = New Posicion();
				$Op = $Op->buscarExtendido($numero_OF, 1);
				$st_doc =  new St_Doc();
				$st_doc = $st_doc->buscarDOC($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				$str_fecha= str_replace("-","",$st_doc->fech_sd);

				$sl_tar =  new Sl_Tar();
				$serv->set_subestado("Busco tareas Particionadas $px_pfp->cdoc_lq $px_pfp->ndoc_lq");
				$sl_tar_lista = $sl_tar->buscarTareasParticionadas($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				$tarea = new Sl_Tar();
				$serv->set_subestado("iniciando proceso de ZRFCPP_CONSUMO_ORDFAB");
				$TIENE_ERRORES_PARA_TRATAR= false;
				foreach ($sl_tar_lista as $tarx) {
					$tarea = $tarx;
					$serv->set_subestado("proceso de ZRFCPP_CONSUMO_ORDFAB>>>>$tarea->nmov_lt");
					if($tarea->declarado_en_sap=="Notificada"){
							continue;
					}
					if ($tarea->declarado_en_sap=="Particionada"){
						$mat = new Material();
						$mat = $mat->buscarExtendido($tarea->nroMaterialSap());						
						if($tarea->hay_error_de_datos()){
							//$serv->pongo_hayError("hay error en relaciones en la orden $numero_OF - con la  tarea:$tarea->nmov_lt");
							echo "hay error en relaciones en la orden $numero_OF - con la  tarea:$tarea->nmov_lt";
							$pend->estado="PAe";
							$pend->save();	
							continue;
						}	
					    if (!$serv->is_running()){exit;}		
						if($xres->FindFirst("Resultado_Ejecucion","RFC like '%CONSUM%' AND id_objeto_sap like '%$numero_OF-LT$tarea->nmov_lt-2' AND (MESSAGE LIKE '%batch input para el dynpro%' OR MESSAGE LIKE '%lo es posible contabilizar en los per%')")){
							$str_fecha=date("Ymd");
						}else{
							$str_fecha= str_replace("-","",$st_doc->fech_sd);
						}
						$tiene_error_178=false;
						if($xres->FindFirst("Resultado_Ejecucion","RFC like '%CONSUM%' AND id_objeto_sap like '%$numero_OF-LT$tarea->nmov_lt%' AND (MESSAGE LIKE '%no se corresponde con orden%') and TYPE='E' AND NUMBER=178")){
							if(!($xres->FindFirst("Resultado_Ejecucion","RFC = 'ZRFCPP_ADDCOMP_ORDFAB' AND id_objeto_sap like '%$numero_OF-LT$tarea->nmov_lt%' AND TYPE='S'" ))){
								include ("ADDCOMP_ORDFAB.php");
								$tiene_error_178=true;
							}
						}
						if($xres->FindFirst("Resultado_Ejecucion","RFC like '%CONSUM%' AND id_objeto_sap like '%$numero_OF-LT$tarea->nmov_lt%' AND (MESSAGE LIKE '%ha excedido la cantidad reservada%') and TYPE='E' AND NUMBER=111")){
							if(!($xres->FindFirst("Resultado_Ejecucion","RFC = 'ZRFCPP_ADDCOMP_ORDFAB' AND id_objeto_sap like '%$numero_OF-LT$tarea->nmov_lt%' AND TYPE='S'" ))){
								include ("ADDCOMP_ORDFAB.php");
								$tiene_error_178=true;
							}
						}
						//RFC Call for ZRFCPP_CONSUMO_ORDFAB
						//Discover interface for function module ZRFCPP_CONSUMO_ORDFAB
						$fce = saprfc_function_discover($rfc,"ZRFCPP_CONSUMO_ORDFAB");
						if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   ZRFCPP_CONSUMO_ORDFAB"  ); exit; }
						//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.
						unset($RETURN,$T_EXBEREIT);
						saprfc_import ($fce,"I_AUFNR",$numero_OF);
						saprfc_import ($fce,"I_COMMIT","X");
						saprfc_import ($fce,"I_ASSIGN","X");
						saprfc_import ($fce,"I_NO_QUAN_CHECK","X");
						saprfc_import ($fce,"I_BLDAT",$str_fecha);
						saprfc_import ($fce,"I_BUDAT",$str_fecha);
						saprfc_import ($fce,"I_VELIN","1");
						
						
						//echo $tarea->cmov_lt.$tarea->nmov_lt."-".$tarea->utor_lt."   HU:".$tarea->nroUtSap()."\r\n";
						
						if($tiene_error_178){
							$reserva=str_pad((int) $nro_reserva,4,"0",STR_PAD_LEFT);
						}else{
							$reserva=str_pad((int) $OF->posicionMaterial($tarea->nroMaterialSap()),4,"0",STR_PAD_LEFT);
						}
						
						//echo "reservaa=".$reserva;
						//Fill internal tables
						saprfc_table_init ($fce,"RETURN");
						saprfc_table_init ($fce,"T_EXBEREIT");
						saprfc_table_append ($fce,"T_EXBEREIT", 
							array ("AUFNR"=>$numero_OF,
							       "RSPOS"=>$reserva,
							       "MATNR"=>$tarea->nroMaterialSap(),
							       "WERKS"=>$Op->PLAN_PLANT,
							       "CHARG"=>$tarea->nroLoteSap(),
							       "LGORT"=>$Op->STORAGE_LOCATION,
							       "SOBKZ"=>"",
							       "VORNR"=>"0010",
							       "MENGE"=>$tarea->cant_lt,
							       "MEINS"=>$mat->MEINS,
							       "ERFMG"=>$tarea->cant_lt,
							       "ERFME"=>$mat->MEINS,
							       "VHILM"=>"P.STD",
							       "EXBNR"=>"",
							       "EXIDV"=>"", //$tarea->nroUtSap(),
							       "EXIDV_OB"=>$tarea->nroUtSap(),
							       "EXPLZ"=>"",
							       "ERNAM"=>"",
							       "ERDAT"=>"",
							       "ERZET"=>"",
							       "TWFLG"=>"X",
							       "BERTS"=>""));
							       
					
						//Do RFC call of function ZRFCPP_CONSUMO_ORDFAB, for handling exceptions use saprfc_exception()
						$rfc_rc = saprfc_call_and_receive ($fce);
						if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
						//Retrieve export parameters
						$rows = saprfc_table_rows ($fce,"RETURN");
						for ($i=1;$i<=$rows;$i++)
							$RETURN[] = saprfc_table_read ($fce,"RETURN",$i);
						$rows = saprfc_table_rows ($fce,"T_EXBEREIT");
						for ($i=1;$i<=$rows;$i++)
							$T_EXBEREIT[] = saprfc_table_read ($fce,"T_EXBEREIT",$i);
						//Debug info
				        $serv->set_subestado("procesando consumos en ZRFCPP_CONSUMO_ORDFAB $tarea->nmov_lt");
							
						foreach ($T_EXBEREIT as $exp) {
							$out = New Out_OrdFab_Consumo();
							$out = $out->buscarExtendido($tarea->nmov_lt);
							foreach ($exp as $k => $v){
								$out->$k = $v;
							};
							$out->objeto_sap=$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt;
							$out->tarea=$tarea->nmov_lt;
							$out->save();
						}
						$i_ret=0;
						$TIENE_ERRORES_151_PARA_TRATAR = false;						   		
						$TIENE_ERRORES_186_PARA_TRATAR = false;						   		
						$TIENE_ERRORES= true;
						foreach($RETURN as $retu){
							if(!($retu[TYPE]=="" && $retu[NUMBER]==0)){
								$i_ret=$i_ret+1;
								$res = new Resultado_Ejecucion();
								$res = $res->buscarExtendido("ZRFCPP_CONSUMO_ORDFAB",$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt."-".$i_ret);	
								$res->RFC="ZRFCPP_CONSUMO_ORDFAB";
								$res->id_objeto_sap=$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt."-".$i_ret;			
								$res->tarea = $tarea->nmov_lt;
								foreach ($retu as $k => $v){
									if ($k=="ID"){
									   $res->ID_SAP = $v;
									}else{
										$res->$k = $v;
									}
								};
								$res->save();
								if($i_ret==2){
									if($res->TYPE=="S" && $res->NUMBER == 0){
										$TIENE_ERRORES = false;
									};
								}
							   	if(($retu[TYPE]=="E" && $retu[NUMBER] == 0 && strpos($retu[MESSAGE],"batch input para el dynpro")!=0)
							   	 ||($retu[TYPE]=="E" && $retu[NUMBER] == 0 && strpos($retu[MESSAGE],"lo es posible contabilizar en los per")!=0)
							   	 ||($res->TYPE=="E" && $res->NUMBER == 186)
							   	 ||($res->TYPE=="E" && $res->NUMBER == 178)
							   	 ||($res->TYPE=="E" && $res->NUMBER == 111)
							   	 ||($res->TYPE=="E" && $res->NUMBER == 151)){
								   	$TIENE_ERRORES_PARA_TRATAR = true;						   		
							   	}
						   	   	if(($res->TYPE=="E" && $res->NUMBER == 186)){
								   	$TIENE_ERRORES_186_PARA_TRATAR = true;						   		
							   	}
						   	   	if(($res->TYPE=="E" && $res->NUMBER == 151)){
								   	$TIENE_ERRORES_151_PARA_TRATAR = true;						   		
							   	}
							   	
							}
						}
						if(!$TIENE_ERRORES){
							$tarea->declarado_en_sap="Notificada";
							$tarea->save();
//						}else{
//							$serv->pongo_hayError("VER LOGS DE ERRORES SAP :: ID_OBJETO_SAP:".$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt."-??");
//							exit();
						}	
						
						saprfc_function_free($fce);
						unset($RETURN,$retu,$i_ret,$fce,$T_EXBEREIT);
						
						if($TIENE_ERRORES_186_PARA_TRATAR){ //trato los errores de HU bloqueadas por control de calidad
							include ("HU_CREATE_GOODMVT.php");
						}	
						if($TIENE_ERRORES_151_PARA_TRATAR){ //trato los errores de HU bloqueadas por control de calidad
							include ("HU_UNPACK.php");
						}	
						
						
					}
					/*****************
					 *   aca coloco un codigo de emergencia para evitar que se produzcan errores de consumo
					 *  
					 */	
					 /*if (declarado_en_sap!="Notificada"){ */
						 
							$sql_ok = true; 
							$sql = "update sl_tar set declarado_en_sap='Notificada' where nmov_lt in (SELECT tarea FROM resultado_ejecucion where rfc like '%consum%' and message like '%se han ejecutado%' and tarea=$tarea->nmov_lt)";   
							try {
								MyActiveRecord :: Query($sql);
							} catch (Exception $e) {
								$sql_ok = false;
							}
					/*} */
				}
				$tiene_tareas_pendientes = false;
				foreach ($sl_tar_lista as $tarx){
					$tarea = $tarx;
					if ($tarea->declarado_en_sap=="Particionada"){
						$tiene_tareas_pendientes=true;
					}	
				}
				if(!$tiene_tareas_pendientes){
					$pend->estado="NOT";
					$pend->consumo=true;
					$pend->save();
				}else{
					if ($TIENE_ERRORES_PARA_TRATAR){
						$pend->estado="CSs";
						$pend->save();
					}else{
						$pend->estado="CSx";
						$pend->save();
					}
				}
			}
			if($pend->consumo==true){
				$pend->estado="NOT";
				$pend->save();
			}
		}
	}
}

unset($sql_ok,$sql,$pendiente,$xres,$lista_pendientes,$px_pfp,$ns_rel,$numero_OF,$OF,$Op,$st_doc,$str_fecha,$sl_tar,$sl_tar_lista,$tarea,$TIENE_ERRORES_PARA_TRATAR,$mat,$fce,$rfc_rc,$rows,$RETURN,$T_EXBEREIT,$out,$i_ret,$TIENE_ERRORES,$retu,$res,$fce,$tiene_tareas_pendientes,$pend);
	
	
?>