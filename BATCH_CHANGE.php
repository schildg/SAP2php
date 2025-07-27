<?php





$pendiente = new Pendiente_Tratar();
$lista_pendientes = $pendiente->todos("Px_Pfp","VEN");
$serv->set_subestado("iniciando proceso de BAPI_BATCH_CHANGE");
if ($lista_pendientes){
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auno_lq!="" and $pend->datos_batch==false){
				$ns_rel = New Ns_Rel();
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$OF = new OrdenProduccion();
				$OF = $OF->buscarExtendido($numero_OF);
				$st_doc =  new St_Doc();
				$st_doc = $st_doc->buscarDOC($px_pfp->cdoc_lq,$px_pfp->ndoc_lq);
				$str_fecha= str_replace("-","",$st_doc->fech_sd);
				
				$st_lot =  new St_Lot();
				$st_lot = $st_lot->buscarLote($px_pfp->lotc_lq,$px_pfp->lotn_lq);
				$str_fecha_venc= str_replace("-","",$st_lot->fven_sl);
				
				//RFC Call for BAPI_BATCH_CHANGE
				//Discover interface for function module BAPI_BATCH_CHANGE
				$fce = saprfc_function_discover($rfc,"BAPI_BATCH_CHANGE");
				if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   BAPI_BATCH_CHANGE"  ); exit; }
				//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.
				
				saprfc_import ($fce,"BATCH",$OF->BATCH);
				saprfc_import ($fce,"BATCHATTRIBUTES", array ("AVAILABLE"=>"","EXPIRYDATE"=>$str_fecha_venc,"STATUSKEY"=>"","VENDOR_NO"=>"","VENDRBATCH"=>$st_lot->lotc_sl.$st_lot->lotn_sl,"VAL_TYPE"=>"","LASTGRDATE"=>"","FREE_DATE1"=>"","FREE_DATE2"=>"","FREE_DATE3"=>"","FREE_DATE4"=>"","FREE_DATE5"=>"","FREE_DATE6"=>"","COUNTRYORI"=>"","COUNTRYORI_ISO"=>"","REGIONORIG"=>"","EXPIMPGRP"=>"","NEXTINSPEC"=>"","PROD_DATE"=>$str_fecha,"DEL_FLAG"=>""));
				saprfc_import ($fce,"BATCHATTRIBUTESX", array ("AVAILABLE"=>"","EXPIRYDATE"=>"X","STATUSKEY"=>"","VENDOR_NO"=>"","VENDRBATCH"=>"X","VAL_TYPE"=>"","LASTGRDATE"=>"","FREE_DATE1"=>"","FREE_DATE2"=>"","FREE_DATE3"=>"","FREE_DATE4"=>"","FREE_DATE5"=>"","FREE_DATE6"=>"","COUNTRYORI"=>"","COUNTRYORI_ISO"=>"","REGIONORIG"=>"","EXPIMPGRP"=>"","NEXTINSPEC"=>"","PROD_DATE"=>"X","DEL_FLAG"=>""));
				saprfc_import ($fce,"BATCHCONTROLFIELDS", array ("BATCHLEVEL"=>"","CLASS_NUM"=>"","DOCLASSIFY"=>"","CALLCFC_CL"=>"","ORG_SYS_OF_BATCH"=>"","SND_SYS_OF_BATCH"=>"","NO_CFC_CALLS"=>""));
				saprfc_import ($fce,"EXTENSION1", array ("KDUMMY"=>""));
				saprfc_import ($fce,"INTERNALNUMBERCOM", array ("VENDOR_NO"=>"","VENDRBATCH"=>"","PURCH_ORG"=>"","ORDER_TYPE"=>"","ORDER_CATG"=>"","WHSE_NO"=>"","WHSE_MVMT"=>"","MATERIAL"=>"","PLANT"=>"","STGE_LOC"=>"","MATL_GROUP"=>"","MATL_TYPE"=>"","DCINDIC"=>"","VAL_CAT"=>"","MOVE_TYPE"=>"","SPEC_STOCK"=>"","MOVE_MATL"=>"","MOVE_PLANT"=>"","MOVE_STLOC"=>"","SPSTCK_PHY"=>"","PROD_MATL"=>"","PROD_PLANT"=>"","SALES_ORD"=>"","S_ORD_ITEM"=>"","SCHED_LINE"=>"","PO_NUMBER"=>"","PO_ITEM"=>"","DOC_CAT"=>"","PO_TYPE"=>"","ORDERID"=>"","ORDER_ITNO"=>"","MVT_IND"=>"","CLSF_BATCH"=>"","MATERIAL_EXTERNAL"=>"","MATERIAL_GUID"=>"","MATERIAL_VERSION"=>"","MOVE_MATL_EXTERNAL"=>"","MOVE_MATL_GUID"=>"","MOVE_MATL_VERSION"=>"","PROD_MATL_EXTERNAL"=>"","PROD_MATL_GUID"=>"","PROD_MATL_VERSION"=>""));
				saprfc_import ($fce,"MATERIAL",$OF->MATERIAL);
				saprfc_import ($fce,"MATERIAL_EVG", array ("MATERIAL_EXT"=>"","MATERIAL_VERS"=>"","MATERIAL_GUID"=>""));
				saprfc_import ($fce,"PLANT",$OF->PRODUCTION_PLANT);
				saprfc_table_init ($fce,"RETURN");
				
				$serv->set_subestado("procesando  BAPI_BATCH_CHANGE");
				
							
				//Do RFC call of function BAPI_BATCH_CHANGE, for handling exceptions use saprfc_exception()
				$rfc_rc = saprfc_call_and_receive ($fce);
				if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
				//Retrieve export parameters
				$rows = saprfc_table_rows ($fce,"RETURN");
				for ($i=1;$i<=$rows;$i++)
					$RETURN[] = saprfc_table_read ($fce,"RETURN",$i);
				
				//Debug info
							
				$res = new Resultado_Ejecucion();
				$res = $res->buscarExtendido("BAPI_BATCH_CHANGE", $numero_OF);	
				$res->RFC="BAPI_BATCH_CHANGE";
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
					$serv->pongo_hayError("SAP informo un Error:: TYPE ".$res->TYPE." ::NUMBER ".$res->NUMBER." ::MESSAGE ".$res->MESSAGE);
					exit;
				}else{
					$pend->estado="PIN";
					$pend->datos_batch=true;
					$pend->save();
				}	
				saprfc_function_free($fce);
				
			}else{
				if ($pend->datos_batch){
					$pend->estado="PIN";
					$pend->save();
				}
				
			}
				
		}
	}
}


unset($pendiente,$lista_pendientes,$px_pfp,$ns_rel,$numero_OF,$OF,$st_doc,$str_fecha,$st_lot,$str_fecha_venc,$fce,$rfc_rc,$rows,$RETURN,$res,$lista_ord_fab,$material,$file_paquete);
	
	
?>