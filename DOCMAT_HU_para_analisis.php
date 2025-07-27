<?php







	$serv->set_subestado("conectando ZRCPP_DOCMAT_HU");

	//Discover interface for function module ZRCPP_DOCMAT_HU
	$fce = saprfc_function_discover($rfc,"ZRCPP_DOCMAT_HU");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZRCPP_DOCMAT_HU"); exit; }
	//Fill internal tables
	saprfc_table_init ($fce,"BATCH_RA");
	saprfc_table_init ($fce,"MATERIAL_RA");
//	saprfc_table_append ($fce,"MATERIAL_RA", array ("SIGN"=>"I","OPTION"=>"BT","LOW"=>"000000000800000226","HIGH"=>"000000000800000226"));
	saprfc_table_init ($fce,"MOVE_TYPE_RA");
	saprfc_table_append ($fce,"MOVE_TYPE_RA", array ("SIGN"=>"I","OPTION"=>"EQ","LOW"=>"101","HIGH"=>""));
	//saprfc_table_append ($fce,"MOVE_TYPE_RA", array ("SIGN"=>"I","OPTION"=>"BT","LOW"=>"501","HIGH"=>"502"));
	//	saprfc_table_append ($fce,"MOVE_TYPE_RA", array ("SIGN"=>"I","OPTION"=>"BT","LOW"=>"561","HIGH"=>"562"));
	saprfc_table_init ($fce,"PLANT_RA");
	saprfc_table_append ($fce,"PLANT_RA", array ("SIGN"=>"I","OPTION"=>"EQ","LOW"=>"2004","HIGH"=>"2004"));
	saprfc_table_init ($fce,"PSTNG_DATE_RA");
	saprfc_table_append ($fce,"PSTNG_DATE_RA", array ("SIGN"=>"I","OPTION"=>"BT","LOW"=>$fecha_inicio,"HIGH"=>$fecha_fin));
	saprfc_table_init ($fce,"RETURN");
	saprfc_table_init ($fce,"SPEC_STOCK_RA");
	saprfc_table_init ($fce,"STGE_LOC_RA");
	saprfc_table_append ($fce,"STGE_LOC_RA", array ("SIGN"=>"I","OPTION"=>"EQ","LOW"=>"ACFE","HIGH"=>"ACFE"));
	saprfc_table_init ($fce,"TR_EV_TYPE_RA");
	saprfc_table_append ($fce,"TR_EV_TYPE_RA", array ("SIGN"=>"I","OPTION"=>"EQ","LOW"=>"WE","HIGH"=>"WE"));
	saprfc_table_init ($fce,"VENDOR_RA");
	saprfc_table_init ($fce,"ZEXPORT2");
	//Do RFC call of function ZRCPP_DOCMAT_HU, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	if (!file_exists(PATH_NOVEDADES_SALIDA) || !file_exists(PATH_NOVEDADES_SALIDA_CONTROL)){$serv->pongo_hayError("NO EXISTEN Ó NO ESTAN CONECTADOS ".PATH_NOVEDADES_SALIDA."  ".PATH_NOVEDADES_SALIDA_CONTROL); exit; }	
	$serv->set_subestado("procesando respuesta ZRCPP_DOCMAT_HU");
	
	$rows = saprfc_table_rows ($fce,"ZEXPORT2");
	for ($i=1;$i<=$rows;$i++)
		$ZEXPORT2[] = saprfc_table_read ($fce,"ZEXPORT2",$i);
		
	$rows = saprfc_table_rows ($fce,"GOODSMVT_HEADER");
	for ($i=1;$i<=$rows;$i++)
		$GOODSMVT_HEADER[] = saprfc_table_read ($fce,"GOODSMVT_HEADER",$i);
		
	$rows = saprfc_table_rows ($fce,"GOODSMVT_ITEMS");
	for ($i=1;$i<=$rows;$i++)
		$GOODSMVT_ITEMS[] = saprfc_table_read ($fce,"GOODSMVT_ITEMS",$i);
		
	$cabecera_mov_mat = array();	
	$linea_mov_mat = array();
	$lote_mov_mat = array();
	$ut_mov_mat = array();	

	$aux_cabecera_mov_mat = array();	
	$aux_linea_mov_mat = array();
	$aux_lote_mov_mat = array();
	$aux_ut_mov_mat = array();	
	
	
	foreach ($ZEXPORT2 as $exp) {
		$listaMovMat = new ListaMovimientoMateriales();	
		$listaMovMat = $listaMovMat->buscarExtendido($exp[MAT_DOC],$exp[DOC_YEAR],$exp[TR_EV_TYPE],$exp[EXIDV],$exp[VENUM],$exp[UNVEL],$exp[MATNR],$exp[CHARG]);
		foreach ($exp as $k => $v){
			$listaMovMat->$k = $v;
		};
		$listaMovMat->save();
		if($exp[UNVEL]==0){  //solo guardo los que no tiene particion de pallet. "SAP Estandard" permite cargar subpallet dentro de un pallet, osea tener 2 materiales distintos dentro del mismo pallet
			                 // por este motivo, se omite la carga de esas lineas. 
			$cabecera_mov_mat = cargo_sin_duplicadosV2($cabecera_mov_mat,$exp[MAT_DOC].$exp[DOC_YEAR] ,array("MAT_DOC"=>$exp[MAT_DOC],"DOC_YEAR"=>$exp[DOC_YEAR],"TR_EV_TYPE"=>$exp[TR_EV_TYPE],"PSTNG_DATE"=>$exp[PSTNG_DATE],"REF_DOC_NO"=>$exp[REF_DOC_NO],"VBELN"=>$exp[VBELN],"WERKS"=>$exp[WERKS],"WDATU"=>$exp[WDATU]));
			$linea_mov_mat = cargo_sin_duplicadosV2($linea_mov_mat,$exp[MAT_DOC].$exp[DOC_YEAR].$exp[MATNR] ,array("MAT_DOC"=>$exp[MAT_DOC],"DOC_YEAR"=>$exp[DOC_YEAR],"VEMNG"=>0,"VEMEH"=>$exp[VEMEH],"MATNR"=>$exp[MATNR]));
			$lote_mov_mat = cargo_sin_duplicadosV2($lote_mov_mat,$exp[MAT_DOC].$exp[DOC_YEAR].$exp[MATNR].$exp[CHARG] ,array("MAT_DOC"=>$exp[MAT_DOC],"DOC_YEAR"=>$exp[DOC_YEAR],"MATNR"=>$exp[MATNR],"CHARG"=>$exp[CHARG],"VEMNG"=>0,"VEMEH"=>$exp[VEMEH],"VFDAT"=>$exp[VFDAT]));
			$ut_mov_mat = cargo_sin_duplicadosV2($ut_mov_mat,$exp[MAT_DOC].$exp[DOC_YEAR].$exp[MATNR].$exp[CHARG].$exp[EXIDV] ,array("MAT_DOC"=>$exp[MAT_DOC],"DOC_YEAR"=>$exp[DOC_YEAR],"MATNR"=>$exp[MATNR],"CHARG"=>$exp[CHARG],"EXIDV"=>$exp[EXIDV],"VEMNG"=>$exp[VEMNG],"VEMEH"=>$exp[VEMEH]));
		}
	}

/*	$control_HU_anidados = array();
	foreach ($ut_mov_mat as $ut){
		if(isset($control_HU_anidados[$ut[MAT_DOC]][$ut[DOC_YEAR]][$ut[EXIDV]])){
			$serv->pongo_hayError("HU anidadas: [$ut[EXIDV]] -- Ver movimiento[".$ut[DOC_YEAR]."_".$ut[MAT_DOC]."]");exit;			
		}else{
			$control_HU_anidados[$ut[MAT_DOC]][$ut[DOC_YEAR]][$ut[EXIDV]]=$ut[MATNR];
		}
	}
	unset($control_HU_anidados);  */
	//  aca actualizo la cabecera con los datos de la tabla GOODSMVT_HEADER, asi guardo una tabla de cabeceras con mas datos 	
	$nueva_cabecera = array();

	foreach ($cabecera_mov_mat as $cab) {
		foreach ($GOODSMVT_HEADER as $hdr) {
			if($cab[MAT_DOC]==$hdr[MAT_DOC] && $cab[DOC_YEAR]==$hdr[DOC_YEAR]){
				foreach ($hdr as $k => $v){
					$cab[$k] = $v;
				};
				$nueva_cabecera = cargo_sin_duplicadosV2($nueva_cabecera,$cab[MAT_DOC].$cab[DOC_YEAR] ,$cab);
			};
		};
	}
	
	$cabecera_mov_mat = $nueva_cabecera;
	
	//  aca actualizo las lineas de los con el tipo de movimiento 	
	$nueva_linea = array();
	$clase_mov = new Clase_Movimiento();
	foreach ($GOODSMVT_ITEMS as $items) {
		foreach ($linea_mov_mat as $lin) {
			if($items[MAT_DOC]==$lin[MAT_DOC] && $items[DOC_YEAR]==$lin[DOC_YEAR] && $items[MATERIAL]==$lin[MATNR]){
				$lin[MOVE_TYPE]=$items[MOVE_TYPE];
				$lin[SIGNO]=$clase_mov->signo($items[MOVE_TYPE]);
				$nueva_linea = cargo_sin_duplicadosV2($nueva_linea,$items[MAT_DOC].$items[DOC_YEAR].$items[MATERIAL],$lin);
			};
		};
	}
	
	$linea_mov_mat = $nueva_linea;
	$lista_materiales = array();	
		
		
		
	
	foreach ($cabecera_mov_mat as $cabecera){
		foreach ($linea_mov_mat as $linea){
			if($linea[MAT_DOC]==$cabecera[MAT_DOC] && $linea[DOC_YEAR]==$cabecera[DOC_YEAR]){
				array_push($lista_materiales, $linea[MATNR]);
				$cant_linea = 0;
				foreach ($lote_mov_mat as $lote){
					if($lote[MAT_DOC]==$linea[MAT_DOC] && $lote[DOC_YEAR]==$linea[DOC_YEAR] && $lote[MATNR]==$linea[MATNR]){
						$cant_lote = 0;
						foreach ($ut_mov_mat as $ut){
							if($ut[MAT_DOC]==$lote[MAT_DOC] && $ut[DOC_YEAR]==$lote[DOC_YEAR] && $ut[MATNR]==$lote[MATNR] && $ut[CHARG]==$lote[CHARG]){
//								$cant_lote = $cant_lote + ($ut[VEMNG] * $linea[SIGNO]);
								$cant_lote = $cant_lote + ($ut[VEMNG]);
							}												
						}
						$lote[VEMNG] = $cant_lote;
						$aux_lote_mov_mat = cargo_sin_duplicadosV2($aux_lote_mov_mat,$lote[MAT_DOC].$lote[DOC_YEAR].$lote[MATNR].$lote[CHARG] , $lote);
						$cant_linea = $cant_linea + $cant_lote;
					}
				}
				$linea[VEMNG] = $cant_linea;
				$aux_linea_mov_mat = cargo_sin_duplicadosV2($aux_linea_mov_mat,$linea[MAT_DOC].$linea[DOC_YEAR].$linea[MATNR] , $linea);
				
			}
		}
	}
	
	$serv->set_subestado("liberando recursos");
	saprfc_function_free($fce);
	
	//include("impoMaterial.php"); esta biblioteca se desahabilita para que se informe el error de que falta el material
	//                             en el caso qde querer habilitarla, comentar la siguiente
	include("impoMaterialNN.php");
	
	
	
	$aux2_cabecera_mov_mat = array();	
	$aux2_linea_mov_mat = array();
	$aux2_lote_mov_mat = array();
	
	foreach ($cabecera_mov_mat as $cabecera){
		$cabMovMat = new CabeceraMovimientoMaterial();
		$cabMovMat = $cabMovMat->buscarExtendido($cabecera[MAT_DOC],$cabecera[DOC_YEAR]);
		foreach ($cabecera as $k =>$v){
			$cabMovMat->$k = $cabecera[$k];
		}
		$cabMovMat->TIPO_MOV="GENEMUESTRA";		
		$cabMovMat->save();
		$aux2_cabecera_mov_mat = cargo_sin_duplicadosV2($aux2_cabecera_mov_mat, $cabecera[MAT_DOC].$cabecera[DOC_YEAR],$cabecera);				
	}
		
	foreach ($aux_linea_mov_mat as $linea){
		$linMovMat = new LineaMovimientoMaterial();
		$linMovMat = $linMovMat->buscarExtendido($linea[MAT_DOC],$linea[DOC_YEAR],$linea[MATNR]);
		foreach ($linea as $k =>$v){
			$linMovMat->$k = $linea[$k];
		}		
		$linMovMat->save();
		$aux2_linea_mov_mat = cargo_sin_duplicadosV2($aux2_linea_mov_mat,$linea[MAT_DOC].$linea[DOC_YEAR].$linea[MATNR] ,$linea);				
	}
				
//				echo "DOCMAT_HU;st-lar;".$tipo_cambio.";".$linea[MATNR].";".$linea[VEMNG].";".$linea[VEMEH].";\r\n";
	foreach ($aux_lote_mov_mat as $lote){
		$lotMovMat = new LoteMovimientoMaterial();
		$lotMovMat = $lotMovMat->buscarExtendido($lote[MAT_DOC],$lote[DOC_YEAR],$lote[MATNR],$lote[CHARG]);
		foreach ($lote as $k =>$v){
			$lotMovMat->$k = $lote[$k];
		}		
		$lotMovMat->save();
		$aux2_lote_mov_mat = cargo_sin_duplicadosV2($aux2_lote_mov_mat,$lote[MAT_DOC].$lote[DOC_YEAR].$lote[MATNR].$lote[CHARG] ,$lote);				
	}
						
	foreach ($ut_mov_mat as $ut){
		$utMovMat = new HUMovimientoMaterial();
		$utMovMat = $utMovMat->buscarExtendido($ut[MAT_DOC],$ut[DOC_YEAR],$ut[MATNR],$ut[CHARG],$ut[EXIDV]);
		foreach ($ut as $k =>$v){
			$utMovMat->$k = $ut[$k];
		}		
		$utMovMat->save();
		$aux2_ut_mov_mat = cargo_sin_duplicadosV2($aux2_ut_mov_mat,$ut[MAT_DOC].$ut[DOC_YEAR].$ut[MATNR].$ut[CHARG].$ut[EXIDV], $ut);
	}
	
	if (!file_exists(PATH_NOVEDADES_SALIDA)){$serv->pongo_hayError("no existe el directorio".PATH_NOVEDADES_SALIDA);exit;};

	$aux2_cabecera_mov_mat = new CabeceraMovimientoMaterial();
	$aux2_cabecera_mov_mat = $aux2_cabecera_mov_mat->FindAll("CabeceraMovimientoMaterial", "TIPO_MOV='GENEMUESTRA' AND Enviado_Anita = ''");

	foreach ($aux2_cabecera_mov_mat as $cabecera){
		foreach ($aux2_linea_mov_mat as $linea){
			if($linea[MAT_DOC]==$cabecera->MAT_DOC && $linea[DOC_YEAR]==$cabecera->DOC_YEAR){
				$serv->paquete="s".str_pad($serv->incrementar_secuencia(),6,"0",STR_PAD_LEFT).".paq";
				$serv->save();
				$file_paquete= fopen(PATH_NOVEDADES_SALIDA.$serv->paquete, "w");
				fwrite($file_paquete,"DOC_MUEST;st-lar;".$cabecera->MAT_DOC.";".$cabecera->DOC_YEAR.";".$cabecera->PSTNG_DATE.";".$linea[MOVE_TYPE].";".$linea[MATNR].";".number_format($linea[VEMNG], 3, '.', '').";".$linea[VEMEH].";\r\n");
				foreach ($aux2_lote_mov_mat as $lote){
					if($lote[MAT_DOC]==$linea[MAT_DOC] && $lote[DOC_YEAR]==$linea[DOC_YEAR] && $lote[MATNR]==$linea[MATNR]){					
						fwrite($file_paquete, "DOC_MUEST;st-rld;".$linea[MATNR].";".$lote[CHARG].";".number_format($lote[VEMNG], 3, '.', '').";".$lote[VEMEH].";".$lote[VFDAT].";\r\n");
						foreach ($aux2_ut_mov_mat as $ut){
							if($ut[MAT_DOC]==$lote[MAT_DOC] && $ut[DOC_YEAR]==$lote[DOC_YEAR] && $ut[MATNR]==$lote[MATNR] && $ut[CHARG]==$lote[CHARG]){
								fwrite($file_paquete, "DOC_MUEST;sl-utr;".$linea[MATNR].";".$lote[CHARG].";".$ut[EXIDV].";".number_format($ut[VEMNG], 3, '.', '').";\r\n");						
							}												
						}
					}
				}
				fclose ($file_paquete);			
				$file_paquete= fopen(PATH_NOVEDADES_SALIDA_CONTROL.$serv->paquete.".con", "w");
				fclose ($file_paquete);								
				$cabecera->Enviado_Anita="SI";
				$cabecera->save();
			}
		}
	}
	
	unset($fce,$rfc_rc,$rows,$ZEXPORT2,$GOODSMVT_HEADER,$GOODSMVT_ITEMS,$cabecera_mov_mat,$linea_mov_mat,$lote_mov_mat,$ut_mov_mat,$aux_cabecera_mov_mat,$aux_linea_mov_mat,$aux_lote_mov_mat,
$aux_ut_mov_mat,$listaMovMat,$control_HU_anidados,$nueva_cabecera,$nueva_linea,$clase_mov,$lista_materiales,$cant_linea,$cant_lote,$aux2_cabecera_mov_mat,$aux2_linea_mov_mat,
$aux2_lote_mov_mat,$aux2_ut_mov_mat,$cabMovMat,$cabMovMat_anteriror,$tipo_cambio_cabecera,$linMovMat,$linMovMat_anteriror,$tipo_cambio_linea,$lotMovMat,$lotMovMat_anteriror,$tipo_cambio_lote,$utMovMat,$utMovMat_anteriror,$tipo_cambio_ut,$file_paquete);

?>