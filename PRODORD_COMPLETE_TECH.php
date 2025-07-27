<?php






$pendiente = new Pendiente_Tratar();
$lista_pendientes = $pendiente->todos("Px_Pfp","CIE");
if ($lista_pendientes){
	$serv->set_subestado("iniciando proceso de BAPI_PRODORD_COMPLETE_TECH");
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auno_lq!="" AND $pend->cierre_tecnico==false){
				$ns_rel = New Ns_Rel();
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$fce = saprfc_function_discover($rfc,"BAPI_PRODORD_COMPLETE_TECH");
				if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   BAPI_PRODORD_COMPLETE_TECH"  ); exit; }
				$serv->set_subestado("procesando BAPI_PRODORD_COMPLETE_TECH");
				saprfc_import ($fce,"SCOPE_COMPL_TECH","1");
				saprfc_import ($fce,"WORK_PROCESS_GROUP","COWORK_BAPI");
				saprfc_import ($fce,"WORK_PROCESS_MAX","99");
				//Fill internal tables
				saprfc_table_init ($fce,"APPLICATION_LOG");
				saprfc_table_init ($fce,"DETAIL_RETURN");
				saprfc_table_init ($fce,"ORDERS");
				saprfc_table_append ($fce,"ORDERS", array ("ORDER_NUMBER"=>$numero_OF));
				//Do RFC call of function BAPI_PRODORD_COMPLETE_TECH, for handling exceptions use saprfc_exception()
				$rfc_rc = saprfc_call_and_receive ($fce);
				if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
				//Retrieve export parameters
				$RETURN = saprfc_export ($fce,"RETURN");
				$rows = saprfc_table_rows ($fce,"APPLICATION_LOG");
				for ($i=1;$i<=$rows;$i++)
					$APPLICATION_LOG[] = saprfc_table_read ($fce,"APPLICATION_LOG",$i);
				$rows = saprfc_table_rows ($fce,"DETAIL_RETURN");
				for ($i=1;$i<=$rows;$i++)
					$DETAIL_RETURN[] = saprfc_table_read ($fce,"DETAIL_RETURN",$i);
				$rows = saprfc_table_rows ($fce,"ORDERS");
				for ($i=1;$i<=$rows;$i++)
					$ORDERS[] = saprfc_table_read ($fce,"ORDERS",$i);
				//Debug info
				
					
				$res = new Resultado_Ejecucion();
				$res = $res->buscarExtendido("BAPI_PRODORD_COMPLETE_TECH", $numero_OF);	
				$res->RFC="BAPI_PRODORD_COMPLETE_TECH";
				$res->id_objeto_sap=$numero_OF;			
				foreach ($RETURN as $k => $v){
					if ($k=="ID"){
					   $res->ID_SAP = $v;
					}else{
						$res->$k = $v;
					}
				};
				$res->save();
				if($res->TYPE!=""){
					foreach ($DETAIL_RETURN as $t) {
						foreach ($t as $k => $v){
							echo $k.":: ".$v."\r\n";
						};
					};
					$serv->pongo_hayError("SAP informo un Error:: TYPE ".$res->TYPE." ::NUMBER ".$res->NUMBER." ::MESSAGE ".$res->MESSAGE);
					exit;
				}else{
					$pend->estado="OKs";
					$pend->cierre_tecnico=true;
					$pend->save();
				}
					
				saprfc_function_free($fce);
				
				
			}else{
				if ($pend->cierre_tecnico){
					$pend->estado="OKs";
					$pend->save();
				}
			}
		}
	}
}


?>