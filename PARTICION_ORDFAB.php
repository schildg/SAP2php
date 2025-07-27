<?php



		$sql_ok = true; 
		$sql = "UPDATE pendiente_tratar SET estado='PAR' WHERE estado='PAs' ";       //trato todas las ordenes pendientes de tratar por haber quedado en pausa
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			$sql_ok = false;
		}



$pendiente = new Pendiente_Tratar();
$lista_pendientes = $pendiente->todos("Px_Pfp","PAR");
if ($lista_pendientes){
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
			$serv->set_subestado("iniciando ZRFCPP_PARTICION_ORDFAB PF $px_pfp->nmov_lq");
			
//			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auno_lq!="" and $pend->particion==false){
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auco_lq!="" and $pend->particion==false){
				$ns_rel = New Ns_Rel();
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$OF = new OrdenProduccion();
				$OF = $OF->buscarExtendido($numero_OF);
				$Op = New Posicion();
				$Op = $Op->buscarExtendido($numero_OF, 1);
				$st_doc =  new St_Doc();
				$st_doc = $st_doc->buscarDOC($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				$str_fecha= str_replace("-","",$st_doc->fech_sd);

				$sl_tar =  new Sl_Tar();
				$sl_tar_lista = $sl_tar->buscarTareas($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				$tarea = new Sl_Tar();
				$serv->set_subestado("iniciando ZRFCPP_PARTICION_ORDFAB");
				$TIENE_ERRORES_PARA_TRATAR= false;
				foreach ($sl_tar_lista as $tarx){
					echo "PAR_ORDFAB.php --> Realizo foreach de lista de tareas, con tarea: (LT) $tarx->nmov_lt \r\n";
				    $serv->set_subestado("iniciando ZRFCPP_PARTICION_ORDFAB tarea $tarx->nmov_lt $tarx->utor_lt");
					$tarea = new Sl_Tar();
					$tarea = $tarea->buscar($tarx->id);
					if ($tarea->cant_lt==0){
							$tarea->declarado_en_sap="Particionada";
							$tarea->save();
					}elseif ($tarea->declarado_en_sap==""){
						$mat = new Material();
						echo "PAR_ORDFAB.php --> No decl en SAP la tarea(LT)$tarx->nmov_lt \r\n";
    				    $serv->set_subestado("iniciando ZRFCPP_PARTICION_ORDFAB tarea $tarx->nmov_lt $tarx->utor_lt");
						$mat = $mat->buscarExtendido($tarea->nroMaterialSap());
						if($tarea->hay_error_de_datos()){
							//$serv->pongo_hayError("hay error en relaciones en la orden $numero_OF - con la  tarea:$tarea->nmov_lt");
							echo "PAR_ORDFAB.php --> hay error en relaciones en la orden $numero_OF - con la  tarea:$tarea->nmov_lt Voy a PAe \r\n";
							
							$pend->estado="PAe";
							$pend->save();	
							continue;
						}
					    if (!$serv->is_running()){exit;}		
						
						//RFC Call for ZRFCPP_PARTICION_ORDFAB
						//Discover interface for function module ZRFCPP_PARTICION_ORDFAB
						$fce = saprfc_function_discover($rfc,"ZRFCPP_PARTICION_ORDFAB");
						if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   ZRFCPP_PARTICION_ORDFAB"  ); exit; }
						//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.
						saprfc_import ($fce,"I_AUFNR",$numero_OF);
						saprfc_import ($fce,"I_COMMIT","X");
						saprfc_import ($fce,"I_ASSIGN","X");
						saprfc_import ($fce,"I_NO_QUAN_CHECK","X");
						saprfc_import ($fce,"I_BLDAT",$str_fecha);
						saprfc_import ($fce,"I_BUDAT",$str_fecha);
						saprfc_import ($fce,"I_VELIN","1");
						//Fill internal tables
						
						//echo $tarea->cmov_lt.$tarea->nmov_lt."-".$tarea->utor_lt."   HU:".$tarea->nroUtSap()."\r\n";
						
						saprfc_table_init ($fce,"RETURN");
						saprfc_table_init ($fce,"T_EXBEREIT");
						saprfc_table_append ($fce,"T_EXBEREIT", 
							array ("AUFNR"=>$numero_OF,
							       "RSPOS"=>str_pad((int) $OF->posicionMaterial($tarea->nroMaterialSap()),4,"0",STR_PAD_LEFT),
							       "MATNR"=>(int)$tarea->nroMaterialSap(),
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
							       
					
						//Do RFC call of function ZRFCPP_PARTICION_ORDFAB, for handling exceptions use saprfc_exception()
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
				        $serv->set_subestado("procesando consumos en ZRFCPP_PARTICION_ORDFAB");
						echo "PAR_ORDFAB.php --> llegué a procesando consumos $tarea->nmov_lt \r\n";
							
						foreach ($T_EXBEREIT as $exp) {
							$out = New Out_OrdFab_Consumo();
    						echo "PAR_ORDFAB.php --> buscarExtendido $tarea->nmov_lt \r\n";

							$out = $out->buscarExtendido($tarea->nmov_lt);
							foreach ($exp as $k => $v){
								$out->$k = $v;
							};
							$out->objeto_sap=$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt;
							$out->tarea=$tarea->nmov_lt;
							$out->save();
						}					
						$i_ret=0;
						$TIENE_ERRORES= false;
						$TIENE_ERRORES_86_PARA_TRATAR = false;						   		
						foreach($RETURN as $retu){
							if(!($retu[TYPE]=="" && $retu[NUMBER]==0)){
								$i_ret=1;
								$res = new Resultado_Ejecucion();
								$res = $res->buscarExtendido("ZRFCPP_PARTICION_ORDFAB",$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt."-".$i_ret);	
								$res->RFC="ZRFCPP_PARTICION_ORDFAB";
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
								if(!(($res->TYPE=="E" && $res->NUMBER == 103)
								   ||($res->TYPE=="I" && $res->NUMBER == 133)
								   ||($res->TYPE=="" && $res->NUMBER == 0)
								   ||($res->TYPE=="I" && $res->NUMBER == 131))){
								   	$TIENE_ERRORES = true;
								   	if(($res->TYPE=="E" && $res->NUMBER == 140)
								   	  ||($res->TYPE=="E" && $res->NUMBER == 86)){
									   	$TIENE_ERRORES_PARA_TRATAR = true;						   		
								   	}
								   	if(($res->TYPE=="E" && $res->NUMBER == 86)){
									   	$TIENE_ERRORES_86_PARA_TRATAR = true;						   		
								   	}
								   	
								};
							}
						}
						if(!$TIENE_ERRORES){
							$tarea->declarado_en_sap="Particionada";
							$tarea->save();
//						}else{
//							$serv->pongo_hayError("VER LOGS DE ERRORES SAP :: ID_OBJETO_SAP:".$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt."-??");
//							exit();
						}	
						
						saprfc_function_free($fce);
						unset($RETURN,$retu,$i_ret,$fce,$T_EXBEREIT);

						if($TIENE_ERRORES_86_PARA_TRATAR){ //trato los errores de los lotes que le faltan el punto en el nro de despacho
							include ("OBJCL_CHANGE.php");
						}	
						
					}	
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
					$pend->estado="CSM";
					$pend->particion=true;
					$pend->save();
				}else{
					if ($TIENE_ERRORES_PARA_TRATAR){
						$pend->estado="PAs";
						$pend->save();
					}else{
						$pend->estado="PAx";
						$pend->save();
					}
				}
			}
			if($pend->particion==true){
				$pend->estado="CSM";
				$pend->save();
			}
			
		}
	}
}

unset($sql_ok,$sql,$pendiente,$lista_pendientes,$px_pfp,$ns_rel,$numero_OF,$OF,$Op,$st_doc,$str_fecha,$sl_tar,$sl_tar_lista,$tarea,$TIENE_ERRORES_PARA_TRATAR,$mat,$pend,$fce,$rfc_rc,$rows,$RETURN,$T_EXBEREIT,$out,$i_ret,$TIENE_ERRORES,$retu,$res,$tiene_tareas_pendientes);
	
	
?>