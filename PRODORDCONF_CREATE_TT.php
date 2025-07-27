<?php




$id_operacion="0010";


$pendiente = new Pendiente_Tratar();
$lista_pendientes = $pendiente->todos("Px_Pfp","NOT");
if ($lista_pendientes){
	$serv->set_subestado("iniciando proceso de BAPI_PRODORDCONF_CREATE_TT");
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auno_lq!="" AND $pend->noti_produccion==false){
				$ns_rel = New Ns_Rel();
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$OF = new OrdenProduccion();
				$OF = $OF->buscarExtendido($numero_OF);
				$Op = New Posicion();
				$Op = $Op->buscarExtendido($numero_OF, 1);
				$st_doc =  new St_Doc();
				$st_doc = $st_doc->buscarDOC($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
	//			$str_fecha= str_replace("-","",$st_doc->fech_sd);
				$str_fecha= str_replace("-","",$px_pfp->ftur_lq);
				$str_anio=substr($str_fecha,0,4);
				$str_mes=substr($str_fecha,4,2);
				$str_dia=substr($str_fecha,6,2);
				$str_fecha=$str_anio.$str_mes.$str_dia;
	//			echo $str_dia."-".$str_mes."-".$str_anio."*".$str_fecha; 
				//RFC Call for BAPI_PRODORDCONF_CREATE_TT
				//Discover interface for function module BAPI_PRODORDCONF_CREATE_TT
				$fce = saprfc_function_discover($rfc,"BAPI_PRODORDCONF_CREATE_TT");
				if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   BAPI_PRODORDCONF_CREATE_TT"  ); exit; }
				$serv->set_subestado("procesando BAPI_PRODORDCONF_CREATE_TT");
				
				saprfc_import ($fce,"POST_WRONG_ENTRIES","");
				saprfc_import ($fce,"TESTRUN","");
				//Fill internal tables
				saprfc_table_init ($fce,"DETAIL_RETURN");
				saprfc_table_init ($fce,"TIMETICKETS");
				saprfc_table_append ($fce,"TIMETICKETS", array ("CONF_NO"=>"0000000000","ORDERID"=>$numero_OF,"SEQUENCE"=>"","OPERATION"=>$id_operacion,"SUB_OPER"=>"","CAPA_CATEGORY"=>"","SPLIT"=>"0","FIN_CONF"=>"X","CLEAR_RES"=>"","POSTG_DATE"=>$str_fecha,"DEV_REASON"=>"","CONF_TEXT"=>"OBSERVACION","PLANT"=>"","WORK_CNTR"=>"","RECORDTYPE"=>"","CONF_QUAN_UNIT"=>"","CONF_QUAN_UNIT_ISO"=>"","YIELD"=>$px_pfp->crem_lq,"SCRAP"=>"","REWORK"=>"","CONF_ACTI_UNIT1"=>"","CONF_ACTI_UNIT1_ISO"=>"","CONF_ACTIVITY1"=>"","NO_REMN_ACTI1"=>"","CONF_ACTI_UNIT2"=>"","CONF_ACTI_UNIT2_ISO"=>"","CONF_ACTIVITY2"=>"","NO_REMN_ACTI2"=>"","CONF_ACTI_UNIT3"=>"","CONF_ACTI_UNIT3_ISO"=>"","CONF_ACTIVITY3"=>"","NO_REMN_ACTI3"=>"","CONF_ACTI_UNIT4"=>"","CONF_ACTI_UNIT4_ISO"=>"","CONF_ACTIVITY4"=>"","NO_REMN_ACTI4"=>"","CONF_ACTI_UNIT5"=>"","CONF_ACTI_UNIT5_ISO"=>"","CONF_ACTIVITY5"=>"","NO_REMN_ACTI5"=>"","CONF_ACTI_UNIT6"=>"","CONF_ACTI_UNIT6_ISO"=>"","CONF_ACTIVITY6"=>"","NO_REMN_ACTI6"=>"","CONF_BUS_PROC_UNIT1"=>"","CONF_BUS_PROC_UNIT1_ISO"=>"","CONF_BUS_PROC1"=>"","NO_REMN_BUS_PROC1"=>"","EXEC_START_DATE"=>"","EXEC_START_TIME"=>"","SETUP_FIN_DATE"=>"","SETUP_FIN_TIME"=>"","PROC_START_DATE"=>"","PROC_START_TIME"=>"","PROC_FIN_DATE"=>"","PROC_FIN_TIME"=>"","TEARDOWN_START_DATE"=>"","TEARDOWN_START_TIME"=>"","EXEC_FIN_DATE"=>"","EXEC_FIN_TIME"=>"","FCST_FIN_DATE"=>"","FCST_FIN_TIME"=>"","STD_UNIT1"=>"","STD_UNIT1_ISO"=>"","FORCAST_STD_VAL1"=>"","STD_UNIT2"=>"","STD_UNIT2_ISO"=>"","FORCAST_STD_VAL2"=>"","STD_UNIT3"=>"","STD_UNIT3_ISO"=>"","FORCAST_STD_VAL3"=>"","STD_UNIT4"=>"","STD_UNIT4_ISO"=>"","FORCAST_STD_VAL4"=>"","STD_UNIT5"=>"","STD_UNIT5_ISO"=>"","FORCAST_STD_VAL5"=>"","STD_UNIT6"=>"","STD_UNIT6_ISO"=>"","FORCAST_STD_VAL6"=>"","FORCAST_BUS_PROC_UNIT1"=>"","FORC_BUS_PROC_UNIT1_ISO"=>"","FORCAST_BUS_PROC_VAL1"=>"","PERS_NO"=>"","TIMEID_NO"=>"","WAGETYPE"=>"","SUITABILITY"=>"","NO_OF_EMPLOYEE"=>"","WAGEGROUP"=>"","BREAK_UNIT"=>"","BREAK_UNIT_ISO"=>"","BREAK_TIME"=>"","EX_CREATED_BY"=>"","EX_CREATED_DATE"=>"","EX_CREATED_TIME"=>"","TARGET_ACTI1"=>"","TARGET_ACTI2"=>"","TARGET_ACTI3"=>"","TARGET_ACTI4"=>"","TARGET_ACTI5"=>"","TARGET_ACTI6"=>"","TARGET_BUS_PROC1"=>"","EX_IDENT"=>"","LOGDATE"=>"","LOGTIME"=>"","WIP_BATCH"=>"","VENDRBATCH"=>"","ME_SFC_ID"=>""));

				//Do RFC call of function BAPI_PRODORDCONF_CREATE_TT, for handling exceptions use saprfc_exception()
				$rfc_rc = saprfc_call_and_receive ($fce);
				if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
				//Retrieve export parameters
				
				$rows = saprfc_table_rows ($fce,"DETAIL_RETURN");
				for ($i=1;$i<=$rows;$i++)
					$DETAIL_RETURN[] = saprfc_table_read ($fce,"DETAIL_RETURN",$i);
				
				$RETURN = saprfc_export ($fce,"RETURN");
				$rows = saprfc_table_rows ($fce,"TIMETICKETS");
				for ($i=1;$i<=$rows;$i++)
					$TIMETICKETS[] = saprfc_table_read ($fce,"TIMETICKETS",$i);
				//Debug info
				
				foreach ($TIMETICKETS as $exp) {
					try {
						$outPro = New Out_ProdOrdConf_Create_TT();
						$outPro = $outPro->buscarExtendido($exp[ORDERID],$exp[OPERATION]);
						foreach ($exp as $k => $v){
							$outPro->$k = $v;
						};
						$outPro->save();
					} catch (Exception $e) {
						$serv->pongo_hayError($e);
					}
				}
				
				try {
					$res = new Resultado_Ejecucion();
					$res = $res->buscarExtendido("BAPI_PRODORDCONF_CREATE_TT", $numero_OF."_".$id_operacion);	
					$res->RFC="BAPI_PRODORDCONF_CREATE_TT";
					$res->id_objeto_sap=$numero_OF."_".$id_operacion;			
					foreach ($RETURN as $k => $v){
						if ($k=="ID"){
						   $res->ID_SAP = $v;
						}else{
							$res->$k = $v;
						}
					};
					$res->save();
				} catch (Exception $e) {
						$serv->pongo_hayError($e);
				}
				
				if($res->TYPE!=""){
					foreach ($DETAIL_RETURN as $t) {
						foreach ($t as $k => $v){
							echo $k.":: ".$v."\r\n";
						};
					};
					$pend->estado="MOx";
					$pend->noti_costo=false;
					$pend->save();
					//					$serv->pongo_hayError("SAP informo un Error:: TYPE ".$res->TYPE." ::NUMBER ".$res->NUMBER." ::MESSAGE ".$res->MESSAGE);
//					exit;
				}else{
					$pend->estado="COM";
					$pend->save();
				}	
				
//				saprfc_function_free($fce);	
				
//*******************************************
                if($pend->estado=="COM"){
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
					$res = $res->buscarExtendido("BAPI_TRANSACTION_COMMIT", $numero_OF."_".$id_operacion);	
					$res->RFC="BAPI_TRANSACTION_COMMIT";
					$res->id_objeto_sap=$numero_OF."_".$id_operacion;			
					foreach ($RETURN as $k => $v){
						if ($k=="ID"){
						   $res->ID_SAP = $v;
						}else{
							$res->$k = $v;
						}
					};
					try {
						$res->save();
					} catch (Exception $e) {
						$serv->pongo_hayError($e);
					}
					if($res->TYPE!=""){
						foreach ($DETAIL_RETURN as $t) {
							foreach ($t as $k => $v){
								echo $k.":: ".$v."\r\n";
							};
						};
						$pend->estado="M1x";
						$pend->noti_costo=false;
						$pend->save();
						//$serv->pongo_hayError("SAP informo un Error:: TYPE ".$res->TYPE." ::NUMBER ".$res->NUMBER." ::MESSAGE ".$res->MESSAGE);
						//exit;
					}else{
						$pend->estado="NO1";
						$pend->noti_produccion=true;
						$pend->save();
					}	
				
                }
				saprfc_function_free($fce);	
			}else{
				if ($pend->noti_produccion){
					$pend->estado="NO1";
					$pend->save();
				}
			}
		}
	}
}

/*********************************************************************************
 * 
 *      DECLARO OPERACION 0020
 * 
 */
	


$id_operacion="0020";


$pendiente = new Pendiente_Tratar();
$lista_pendientes = $pendiente->todos("Px_Pfp","NO1");
if ($lista_pendientes){
	$serv->set_subestado("iniciando proceso de BAPI_PRODORDCONF_CREATE_TT");
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 and $pend->noti_costo==false){
				$ns_rel = New Ns_Rel();
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$OF = new OrdenProduccion();
				$OF = $OF->buscarExtendido($numero_OF);
				$st_doc =  new St_Doc();
				$st_doc = $st_doc->buscarDOC($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				$str_fecha= str_replace("-","",$st_doc->fech_sd);
				$str_anio=substr($str_fecha,0,4);
				$str_mes=substr($str_fecha,4,2);
				$str_dia=substr($str_fecha,6,2);
				$str_fecha=$str_anio.$str_mes.$str_dia;
				//echo $str_dia."-".$str_mes."-".$str_anio."*".$str_fecha; 
				//RFC Call for BAPI_PRODORDCONF_CREATE_TT
				//Discover interface for function module BAPI_PRODORDCONF_CREATE_TT
				$fce = saprfc_function_discover($rfc,"BAPI_PRODORDCONF_CREATE_TT");
				if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   BAPI_PRODORDCONF_CREATE_TT"  ); exit; }
				$serv->set_subestado("procesando BAPI_PRODORDCONF_CREATE_TT");
				
				saprfc_import ($fce,"POST_WRONG_ENTRIES","");
				saprfc_import ($fce,"TESTRUN","");
				//Fill internal tables
				saprfc_table_init ($fce,"DETAIL_RETURN");
				saprfc_table_init ($fce,"TIMETICKETS");
				saprfc_table_append ($fce,"TIMETICKETS", array ("CONF_NO"=>"0000000000","ORDERID"=>$numero_OF,"SEQUENCE"=>"","OPERATION"=>$id_operacion,"SUB_OPER"=>"","CAPA_CATEGORY"=>"","SPLIT"=>"0","FIN_CONF"=>"X","CLEAR_RES"=>"","POSTG_DATE"=>$str_fecha,"DEV_REASON"=>"","CONF_TEXT"=>"OBSERVACION","PLANT"=>"","WORK_CNTR"=>"","RECORDTYPE"=>"","CONF_QUAN_UNIT"=>"","CONF_QUAN_UNIT_ISO"=>"","YIELD"=>$px_pfp->crem_lq,"SCRAP"=>"","REWORK"=>"","CONF_ACTI_UNIT1"=>"","CONF_ACTI_UNIT1_ISO"=>"","CONF_ACTIVITY1"=>"","NO_REMN_ACTI1"=>"","CONF_ACTI_UNIT2"=>"","CONF_ACTI_UNIT2_ISO"=>"","CONF_ACTIVITY2"=>"","NO_REMN_ACTI2"=>"","CONF_ACTI_UNIT3"=>"","CONF_ACTI_UNIT3_ISO"=>"","CONF_ACTIVITY3"=>"","NO_REMN_ACTI3"=>"","CONF_ACTI_UNIT4"=>"","CONF_ACTI_UNIT4_ISO"=>"","CONF_ACTIVITY4"=>"","NO_REMN_ACTI4"=>"","CONF_ACTI_UNIT5"=>"","CONF_ACTI_UNIT5_ISO"=>"","CONF_ACTIVITY5"=>"","NO_REMN_ACTI5"=>"","CONF_ACTI_UNIT6"=>"","CONF_ACTI_UNIT6_ISO"=>"","CONF_ACTIVITY6"=>"","NO_REMN_ACTI6"=>"","CONF_BUS_PROC_UNIT1"=>"","CONF_BUS_PROC_UNIT1_ISO"=>"","CONF_BUS_PROC1"=>"","NO_REMN_BUS_PROC1"=>"","EXEC_START_DATE"=>"","EXEC_START_TIME"=>"","SETUP_FIN_DATE"=>"","SETUP_FIN_TIME"=>"","PROC_START_DATE"=>"","PROC_START_TIME"=>"","PROC_FIN_DATE"=>"","PROC_FIN_TIME"=>"","TEARDOWN_START_DATE"=>"","TEARDOWN_START_TIME"=>"","EXEC_FIN_DATE"=>"","EXEC_FIN_TIME"=>"","FCST_FIN_DATE"=>"","FCST_FIN_TIME"=>"","STD_UNIT1"=>"","STD_UNIT1_ISO"=>"","FORCAST_STD_VAL1"=>"","STD_UNIT2"=>"","STD_UNIT2_ISO"=>"","FORCAST_STD_VAL2"=>"","STD_UNIT3"=>"","STD_UNIT3_ISO"=>"","FORCAST_STD_VAL3"=>"","STD_UNIT4"=>"","STD_UNIT4_ISO"=>"","FORCAST_STD_VAL4"=>"","STD_UNIT5"=>"","STD_UNIT5_ISO"=>"","FORCAST_STD_VAL5"=>"","STD_UNIT6"=>"","STD_UNIT6_ISO"=>"","FORCAST_STD_VAL6"=>"","FORCAST_BUS_PROC_UNIT1"=>"","FORC_BUS_PROC_UNIT1_ISO"=>"","FORCAST_BUS_PROC_VAL1"=>"","PERS_NO"=>"","TIMEID_NO"=>"","WAGETYPE"=>"","SUITABILITY"=>"","NO_OF_EMPLOYEE"=>"","WAGEGROUP"=>"","BREAK_UNIT"=>"","BREAK_UNIT_ISO"=>"","BREAK_TIME"=>"","EX_CREATED_BY"=>"","EX_CREATED_DATE"=>"","EX_CREATED_TIME"=>"","TARGET_ACTI1"=>"1","TARGET_ACTI2"=>"1","TARGET_ACTI3"=>"1","TARGET_ACTI4"=>"","TARGET_ACTI5"=>"","TARGET_ACTI6"=>"","TARGET_BUS_PROC1"=>"","EX_IDENT"=>"","LOGDATE"=>"","LOGTIME"=>"","WIP_BATCH"=>"","VENDRBATCH"=>"","ME_SFC_ID"=>""));

				//Do RFC call of function BAPI_PRODORDCONF_CREATE_TT, for handling exceptions use saprfc_exception()
				$rfc_rc = saprfc_call_and_receive ($fce);
				if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
				//Retrieve export parameters
				
				$rows = saprfc_table_rows ($fce,"DETAIL_RETURN");
				for ($i=1;$i<=$rows;$i++)
					$DETAIL_RETURN[] = saprfc_table_read ($fce,"DETAIL_RETURN",$i);
				
				$RETURN = saprfc_export ($fce,"RETURN");
				$rows = saprfc_table_rows ($fce,"TIMETICKETS");
				for ($i=1;$i<=$rows;$i++)
					$TIMETICKETS[] = saprfc_table_read ($fce,"TIMETICKETS",$i);
				//Debug info
				
				foreach ($TIMETICKETS as $exp) {
					$outPro = New Out_ProdOrdConf_Create_TT();
					$outPro = $outPro->buscarExtendido($exp[ORDERID],$exp[OPERATION]);
					foreach ($exp as $k => $v){
						$outPro->$k = $v;
					};
					try {
						$outPro->save();
					} catch (Exception $e) {
						$serv->pongo_hayError($e);
					}
				}
									
				$res = new Resultado_Ejecucion();
				$res = $res->buscarExtendido("BAPI_PRODORDCONF_CREATE_TT", $numero_OF."_".$id_operacion);	
				$res->RFC="BAPI_PRODORDCONF_CREATE_TT";
				$res->id_objeto_sap=$numero_OF."_".$id_operacion;			
				foreach ($RETURN as $k => $v){
					if ($k=="ID"){
					   $res->ID_SAP = $v;
					}else{
						$res->$k = $v;
					}
				};
					try {
						$res->save();
					} catch (Exception $e) {
						$serv->pongo_hayError($e);
					}
					if($res->TYPE!=""){
					foreach ($DETAIL_RETURN as $t) {
						foreach ($t as $k => $v){
							echo $k.":: ".$v."\r\n";
						};
					};
					$pend->estado="C1x";
					$pend->noti_costo=false;
					$pend->save();
					//$serv->pongo_hayError("SAP informo un Error:: TYPE ".$res->TYPE." ::NUMBER ".$res->NUMBER." ::MESSAGE ".$res->MESSAGE);
					//exit;
				}else{
					$pend->estado="CO1";
					$pend->save();
				}	
//				saprfc_function_free($fce);	
				
				
//*******************************************
                if($pend->estado=="CO1"){
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
					$res = $res->buscarExtendido("BAPI_TRANSACTION_COMMIT", $numero_OF."_".$id_operacion);	
					$res->RFC="BAPI_TRANSACTION_COMMIT";
					$res->id_objeto_sap=$numero_OF."_".$id_operacion;			
					foreach ($RETURN as $k => $v){
						if ($k=="ID"){
						   $res->ID_SAP = $v;
						}else{
							$res->$k = $v;
						}
					};
					try {
						$res->save();
					} catch (Exception $e) {
						$serv->pongo_hayError($e);
					}
					if($res->TYPE=""){
						//$serv->pongo_hayError("SAP informo un Error:: TYPE ".$res->TYPE." ::NUMBER ".$res->NUMBER." ::MESSAGE ".$res->MESSAGE);
						//exit;
						$pend->estado="S0x";
						$pend->noti_costo=false;
						$pend->save();
					}else{
						$pend->estado="CON";
						$pend->noti_costo=true;
						$pend->save();
					}	
				
                }
                saprfc_function_free($fce);	
			}else{
				if ($pend->noti_costo){
					$pend->estado="CON";
					$pend->save();
				}
			}                
		}
	}
}


?>