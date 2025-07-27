<?php




$serv->set_subestado("Buscando ordenes Pendiente de Notificar");
$pendiente = new Pendiente_Tratar();
$lista_pendientes = $pendiente->todos("Px_Pfp","PEN");
$serv->set_subestado("iniciando proceso de BAPI_PRODORD_CHANGE");
if ($lista_pendientes){
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
			$serv->set_subestado("iniciando proceso de BAPI_PRODORD_CHANGE $px_pfp->nmov_lq");
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auno_lq!="" and $pend->modi_cabecera==false){
				$ns_rel = New Ns_Rel();
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$OF = new OrdenProduccion();
				$OF = $OF->buscarExtendido($numero_OF);
				
				$str_fecha= str_replace("-","",$px_pfp->fefi_lq);
				$sl_tar=new Sl_Tar();
				$sl_tar=$sl_tar->FindFirst("Sl_Tar","tipo_lt='006' and itom_lt='015' and cdoc_lt='$px_pfp->cmov_lq' and ndoc_lt=$px_pfp->nmov_lq");
				$sl_tar_ini=new Sl_Tar();
				$sl_tar_ini=$sl_tar_ini->FindFirst("Sl_Tar","tipo_lt='006' and itom_lt='002' and cdoc_lt='$px_pfp->cmov_lq' and ndoc_lt=$px_pfp->nmov_lq","fasi_lt,hasi_lt ASC");
				
				//RFC Call for BAPI_PRODORD_CHANGE
				//Discover interface for function module BAPI_PRODORD_CHANGE
				$fce = saprfc_function_discover($rfc,"BAPI_PRODORD_CHANGE");
				if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   BAPI_PRODORD_CHANGE"  ); exit; }
				//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.
				echo "tipo_lt=6 and itom_lt=15 and cdoc_lt='$px_pfp->cmov_lq' and ndoc_lt=$px_pfp->nmov_lq"."\r\n";
				echo "tipo_lt=6 and itom_lt=002 and cdoc_lt='$px_pfp->cmov_lq' and ndoc_lt=$px_pfp->nmov_lq --> $sl_tar_ini->fasi_lt $sl_tar_ini->nmov_lt"."\r\n";

				//				 $j=array ("BASIC_START_DATE"=>str_replace("-","",$sl_tar_ini->fasi_lt),"BASIC_START_TIME"=>sprintf("%'.06d",$sl_tar_ini->hasi_lt.'00'),"BASIC_END_DATE"=>str_replace("-","",$sl_tar->ffin_lt),"BASIC_END_TIME"=>sprintf("%'.06d",$sl_tar->hfin_lt.'00'),"QUANTITY"=>"","SCRAP_QUANTITY"=>"","QUANTITY_UOM"=>"","ROUTING_TYPE"=>"","ROUTING_GROUP"=>"","ROUTING_COUNTER"=>"","PROD_VERSION"=>"","EXPLOSION_DATE"=>"","ORDER_PRIORITY"=>"","MRP_CONTROLLER"=>"","EXPLODE_NEW"=>"","BUSINESS_AREA"=>"","PROFIT_CENTER"=>"","SEQUENCE_NUMBER"=>$px_pfp->nmov_lq,"STOCK_TYPE"=>"","GR_PROC_TIME"=>"","STORAGE_LOCATION"=>"","MRP_DISTR_KEY"=>"","GOODS_RECIPIENT"=>"","UNLOADING_POINT"=>"","POSITION_NUMBER"=>"","ADDITIONAL_DAYS"=>"");
//				 Var_Dump($j);
				saprfc_import ($fce,"NUMBER",$numero_OF);
				saprfc_import ($fce,"ORDERDATA",array ("BASIC_START_DATE"=>str_replace("-","",$sl_tar_ini->fasi_lt),"BASIC_START_TIME"=>sprintf("%'.06d",$sl_tar_ini->hasi_lt.'00'),"BASIC_END_DATE"=>str_replace("-","",$sl_tar->ffin_lt),"BASIC_END_TIME"=>sprintf("%'.06d",$sl_tar->hfin_lt.'00'),"QUANTITY"=>"","SCRAP_QUANTITY"=>"","QUANTITY_UOM"=>"","ROUTING_TYPE"=>"","ROUTING_GROUP"=>"","ROUTING_COUNTER"=>"","PROD_VERSION"=>"","EXPLOSION_DATE"=>"","ORDER_PRIORITY"=>"","MRP_CONTROLLER"=>"","EXPLODE_NEW"=>"","BUSINESS_AREA"=>"","PROFIT_CENTER"=>"","SEQUENCE_NUMBER"=>$px_pfp->nmov_lq,"STOCK_TYPE"=>"","GR_PROC_TIME"=>"","STORAGE_LOCATION"=>"","MRP_DISTR_KEY"=>"","GOODS_RECIPIENT"=>"","UNLOADING_POINT"=>"","POSITION_NUMBER"=>"","ADDITIONAL_DAYS"=>""));
				saprfc_import ($fce,"ORDERDATAX", array ("BASIC_START_DATE"=>"X","BASIC_END_DATE"=>"X","QUANTITY"=>"","SCRAP_QUANTITY"=>"","QUANTITY_UOM"=>"","ROUTING"=>"","PROD_VERSION"=>"","EXPLOSION_DATE"=>"","ORDER_PRIORITY"=>"","MRP_CONTROLLER"=>"","BUSINESS_AREA"=>"","PROFIT_CENTER"=>"","SEQUENCE_NUMBER"=>"X","STOCK_TYPE"=>"","GR_PROC_TIME"=>"","STORAGE_LOCATION"=>"","MRP_DISTR_KEY"=>"","GOODS_RECIPIENT"=>"","UNLOADING_POINT"=>"","ADDITIONAL_DAYS"=>""));
//				saprfc_import ($fce,"ORDERDATA",array ("BASIC_START_DATE"=>"","BASIC_START_TIME"=>"","BASIC_END_DATE"=>"","BASIC_END_TIME"=>"","QUANTITY"=>"","SCRAP_QUANTITY"=>"","QUANTITY_UOM"=>"","ROUTING_TYPE"=>"","ROUTING_GROUP"=>"","ROUTING_COUNTER"=>"","PROD_VERSION"=>"","EXPLOSION_DATE"=>"","ORDER_PRIORITY"=>"","MRP_CONTROLLER"=>"","EXPLODE_NEW"=>"","BUSINESS_AREA"=>"","PROFIT_CENTER"=>"","SEQUENCE_NUMBER"=>$px_pfp->nmov_lq,"STOCK_TYPE"=>"","GR_PROC_TIME"=>"","STORAGE_LOCATION"=>"","MRP_DISTR_KEY"=>"","GOODS_RECIPIENT"=>"","UNLOADING_POINT"=>"","POSITION_NUMBER"=>"","ADDITIONAL_DAYS"=>""));
//				saprfc_import ($fce,"ORDERDATAX", array ("BASIC_START_DATE"=>"","BASIC_END_DATE"=>"","QUANTITY"=>"","SCRAP_QUANTITY"=>"","QUANTITY_UOM"=>"","ROUTING"=>"","PROD_VERSION"=>"","EXPLOSION_DATE"=>"","ORDER_PRIORITY"=>"","MRP_CONTROLLER"=>"","BUSINESS_AREA"=>"","PROFIT_CENTER"=>"","SEQUENCE_NUMBER"=>"X","STOCK_TYPE"=>"","GR_PROC_TIME"=>"","STORAGE_LOCATION"=>"","MRP_DISTR_KEY"=>"","GOODS_RECIPIENT"=>"","UNLOADING_POINT"=>"","ADDITIONAL_DAYS"=>""));
		
				
				$serv->set_subestado("procesando  BAPI_PRODORD_CHANGE $px_pfp->nmov_lq");
				
							
				//Do RFC call of function BAPI_PRODORD_CHANGE, for handling exceptions use saprfc_exception()
				$rfc_rc = saprfc_call_and_receive ($fce);
				if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
				//Retrieve export parameters
				$MASTER_DATA_READ = saprfc_export ($fce,"MASTER_DATA_READ");
				$ORDER_STATUS = saprfc_export ($fce,"ORDER_STATUS");
				$ORDER_TYPE = saprfc_export ($fce,"ORDER_TYPE");
				$RETURN = saprfc_export ($fce,"RETURN");
				
				//Debug info
							
				$res = new Resultado_Ejecucion();
				$res = $res->buscarExtendido("BAPI_PRODORD_CHANGE", $numero_OF);	
				$res->RFC="BAPI_PRODORD_CHANGE";
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
					$pend->estado="VEN";
					$pend->modi_cabecera=true;
					$pend->save();
				}	
				saprfc_function_free($fce);
				
			}else{
				if ($pend->modicabecera){
					$pend->estado="VEN";
					$pend->save();
				}
				
			}
				
		}
	}
}

unset($pendiente,$lista_pendientes,$px_pfp,$ns_rel,$numero_OF,$OF,$str_fecha,$sl_tar,$fce,$rfc_rc,$MASTER_DATA_READ,$ORDER_STATUS,$ORDER_TYPE,$RETURN,$res,$rows,$ZRANGEPLNBEZ,$ZRANGESTAT,$ZRANGEWERKS,$lista_materiales,$cabecera_formulas,$hd,$operation,$component,$position,$lista_ord_fab,$material,$file_paquete);
	
	
?>