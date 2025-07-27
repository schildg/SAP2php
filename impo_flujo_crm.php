<?php





/*********************************************************************************************************
 * 
 *        ARGENTINA
 * 
 *********************************************************************************************************/	
	$actu_flujo= new Actu_Flujo_CRM();
	$lista_actu_flujo =  $actu_flujo->FindAll("Actu_Flujo_CRM","Flujo_Actualizado =0");
	foreach ($lista_actu_flujo as $af){
			
		$sql_ok = true; 
		$sql = "TRUNCATE TABLE `flujo_crm_tmp`";       //borro todo los pedidos de la tabla tremporal
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			$sql_ok = false;
		}

		
		
		$serv->set_subestado("iniciando proceso BAPI_MATERIAL_STOCK_REQ_LIST($af->BUKRS      $af->WERKS)");
		$fce = saprfc_function_discover($rfc,"BAPI_MATERIAL_STOCK_REQ_LIST");
		if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed BAPI_MATERIAL_STOCK_REQ_LIST"); exit; }
		
		saprfc_import ($fce,"DISPLAY_FILTER","");
		saprfc_import ($fce,"GET_IND_LINES","X");
		saprfc_import ($fce,"GET_ITEM_DETAILS","");
		saprfc_import ($fce,"GET_TOTAL_LINES","");
		saprfc_import ($fce,"IGNORE_BUFFER","");
		saprfc_import ($fce,"MATERIAL",$af->MATNR);
		saprfc_import ($fce,"MATERIAL_EVG", array ("MATERIAL_EXT"=>"","MATERIAL_VERS"=>"","MATERIAL_GUID"=>""));
		saprfc_import ($fce,"MRP_AREA","");
		saprfc_import ($fce,"PERIOD_INDICATOR","");
		saprfc_import ($fce,"PLANT",$af->WERKS);
		saprfc_import ($fce,"PLAN_SCENARIO","");
		saprfc_import ($fce,"SELECTION_RULE","");
		//Fill internal tables
		saprfc_table_init ($fce,"EXTENSIONOUT");
		saprfc_table_append ($fce,"EXTENSIONOUT", array ("STRUCTURE"=>"","VALUEPART1"=>"","VALUEPART2"=>"","VALUEPART3"=>"","VALUEPART4"=>""));
		saprfc_table_init ($fce,"MRP_IND_LINES");
		saprfc_table_init ($fce,"MRP_ITEMS");
		saprfc_table_init ($fce,"MRP_TOTAL_LINES");
		//Do RFC call of function BAPI_MATERIAL_STOCK_REQ_LIST, for handling exceptions use saprfc_exception()
		$rfc_rc = saprfc_call_and_receive ($fce);
		if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
		$serv->set_subestado("procesando respuesta BAPI_MATERIAL_STOCK_REQ_LIST($af->BUKRS      $af->WERKS)");
			//Retrieve export parameters
	/*	$MRP_CONTROL_PARAM = saprfc_export ($fce,"MRP_CONTROL_PARAM");
		$MRP_LIST = saprfc_export ($fce,"MRP_LIST");
		$MRP_STOCK_DETAIL = saprfc_export ($fce,"MRP_STOCK_DETAIL");
		$RETURN = saprfc_export ($fce,"RETURN");
		$rows = saprfc_table_rows ($fce,"EXTENSIONOUT");
		for ($i=1;$i<=$rows;$i++)
			$EXTENSIONOUT[] = saprfc_table_read ($fce,"EXTENSIONOUT",$i);
	*/	$rows = saprfc_table_rows ($fce,"MRP_IND_LINES");
		for ($i=1;$i<=$rows;$i++)
			$MRP_IND_LINES[] = saprfc_table_read ($fce,"MRP_IND_LINES",$i);
	/*	$rows = saprfc_table_rows ($fce,"MRP_ITEMS");
		for ($i=1;$i<=$rows;$i++)
			$MRP_ITEMS[] = saprfc_table_read ($fce,"MRP_ITEMS",$i);
		$rows = saprfc_table_rows ($fce,"MRP_TOTAL_LINES");
		for ($i=1;$i<=$rows;$i++)
			$MRP_TOTAL_LINES[] = saprfc_table_read ($fce,"MRP_TOTAL_LINES",$i);
		//Debug info
	*/  
		$indice=0;
		foreach ($MRP_IND_LINES as $flows) {
			$flow = new Flujo_CRM_TMP();
			foreach ($flows as $k =>$v){
					$flow->$k = $flows[$k];
				}
			$indice=$indice+1;
			$flow->MATNR=$af->MATNR;
			$flow->BUKRS=$af->BUKRS;
			$flow->WERKS=$af->WERKS;
			$flow->ORDEN=$indice;	
			$flow->save();
			if (!$serv->is_running()){exit;}
		}
			
	
		
		saprfc_function_free($fce);
		unset($indice,$flow,$flows,$MRP_IND_LINES,$fce,$rfc_rc);
		/*********************************************************************************************************
		 * 
		 *        parte COMUN A TODOS LOS PROCESOS
		 * 
		 *********************************************************************************************************/	
			
			$serv->set_subestado("procesando respuestas BAPI_MATERIAL_STOCK_REQ_LIST(SQL)");
			
			$sql = "START TRANSACTION";
			try {
				MyActiveRecord :: Query($sql);
				
				$sql = "INSERT IGNORE INTO STOCK_CRM_TODO (BUKRS,WERKS,LGORT,MATNR) SELECT BUKRS,WERKS,LGORT,MATNR FROM `cpendientes_crm_todo` AS P WHERE LGORT!='' AND WERKS!='' AND MATNR!='' GROUP BY BUKRS,WERKS,LGORT,MATNR";
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					echo "ERROR::".$sql."||".$e."\r\n";
					throw ($e);
				}		
				
				
				$sql_ok = true; 
				$sql = "update actu_flujo_crm a  left join flujo_crm_tmp t   on t.matnr = a.matnr and t.werks = a.werks and t.bukrs=a.bukrs
				  set a.Flujo_Actualizado=1  where t.matnr is not null";       //borro 
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					echo "ERROR::".$sql."||".$e."\r\n";
					throw ($e);
				}		
						
			
			   // actualizo clientes desde los pedidos pendientes de venta.
				$sql = "update `flujo_crm_tmp` as f left join ppendientes_crm_todo as p on SUBSTRING_INDEX(SUBSTRING_INDEX(f.`ELEMNT_DATA`, '/', 1), ' ', -1)=p.vbeln and f.matnr=p.matnr and f.customer=p.kunnr and f.bukrs=p.bukrs set f.crm_id=p.crm_id,f.vkorg=p.vkorg,f.unneg=p.unneg where (`MRP_ELEMNT`='Entr.' or `MRP_ELEMNT`='EntrGr' or `MRP_ELEMNT`='OrdClt') and p.vkorg is not null";
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					echo "ERROR::".$sql."||".$e."\r\n";
					throw ($e);
				}		
						
			   // actualizo clientes desde los pedidos pendientes de compra.
				$sql = "update `flujo_crm_tmp` as f left join cpendientes_crm_todo as p on SUBSTRING_INDEX(SUBSTRING_INDEX(f.`ELEMNT_DATA`, '/', 1), ' ', -1)=p.ebeln and f.matnr=p.matnr and f.vendor_no=p.lifnr and f.bukrs=p.bukrs set f.crm_id=p.crm_id,f.vkorg=p.ekorg where (`MRP_ELEMNT`='NecSC' or `MRP_ELEMNT`='RepPed' or `MRP_ELEMNT`='AvConf' or `MRP_ELEMNT`='Devol.') and p.ekorg is not null";
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					echo "ERROR::".$sql."||".$e."\r\n";
					throw ($e);
				}		
							
				$sql = "update flujo_crm_todo as p left join flujo_crm_tmp as t on p.MATNR=t.MATNR AND p.BUKRS=t.BUKRS AND p.WERKS=t.WERKS AND p.ORDEN=t.ORDEN set p.BUKRS=t.BUKRS,p.MATNR=t.MATNR,p.WERKS=t.WERKS,p.ORDEN=t.ORDEN,p.PLNGSEGMT=t.PLNGSEGMT,p.PLNGSEGNO=t.PLNGSEGNO,p.SORT_DATE=t.SORT_DATE,p.SORTIND_00=t.SORTIND_00,p.SORTIND_01=t.SORTIND_01,p.SORTIND_02=t.SORTIND_02,p.MRP_ELEMENT_IND=t.MRP_ELEMENT_IND,p.PLUS_MINUS=t.PLUS_MINUS,p.AVAILABLE=t.AVAILABLE,p.AVAIL_DATE=t.AVAIL_DATE,p.FINISH_DATE=t.FINISH_DATE,p.MRP_ELEMNT=t.MRP_ELEMNT,p.ELEMNT_DATA=t.ELEMNT_DATA,p.EXCMSGKEY=t.EXCMSGKEY,p.EXCMESSAGE=t.EXCMESSAGE,p.REC_REQD_QTY=t.REC_REQD_QTY,p.AVAIL_QTY1=t.AVAIL_QTY1,p.AVAIL_QTY2=t.AVAIL_QTY2,p.ATP_QTY=t.ATP_QTY,p.FBYTE=t.FBYTE,p.SELECTION=t.SELECTION,p.EXCEP_IND=t.EXCEP_IND,p.PROD_VERSION=t.PROD_VERSION,p.BOMEXPL_NO=t.BOMEXPL_NO,p.REV_LEV=t.REV_LEV,p.SCRAP=t.SCRAP,p.START_DATE=t.START_DATE,p.OPEN_DATE=t.OPEN_DATE,p.SPPROCTYPE=t.SPPROCTYPE,p.EXT_SPPROCTYPE=t.EXT_SPPROCTYPE,p.PLAN_PLANT1=t.PLAN_PLANT1,p.PLAN_PLANT2=t.PLAN_PLANT2,p.STG_LOC_2=t.STG_LOC_2,p.STORAGE_LOC=t.STORAGE_LOC,p.RESCHED_DATE=t.RESCHED_DATE,p.VENDOR_NO=t.VENDOR_NO,p.CUSTOMER=t.CUSTOMER,p.CUST_NAME=t.CUST_NAME,p.VEND_NAME=t.VEND_NAME,p.LOW_LEVEL_EXCPT=t.LOW_LEVEL_EXCPT,p.STOCK_IN_TRANSIT=t.STOCK_IN_TRANSIT,p.USER_EXIT1=t.USER_EXIT1,p.USER_EXIT2=t.USER_EXIT2,p.USER_EXIT3=t.USER_EXIT3,p.SORTIND_KD=t.SORTIND_KD,p.REC_REQD_QTY_ALT_UOM=t.REC_REQD_QTY_ALT_UOM,p.AVAIL_QTY_ALT_UOM=t.AVAIL_QTY_ALT_UOM,p.TEXT_FIELD_ALT_UOM=t.TEXT_FIELD_ALT_UOM,p.ICON_TEXT=t.ICON_TEXT,p.CRM_ID=t.CRM_ID,p.VKORG=t.VKORG,p.UNNEG=t.UNNEG  where t.id is not null";
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					echo "ERROR::".$sql."||".$e."\r\n";
					throw ($e);
				}		
							
				
				$sql = "insert into flujo_crm_todo (KEY_ID,BUKRS,MATNR,WERKS,ORDEN,PLNGSEGMT,PLNGSEGNO,SORT_DATE,SORTIND_00,SORTIND_01,SORTIND_02,MRP_ELEMENT_IND,PLUS_MINUS,AVAILABLE,AVAIL_DATE,FINISH_DATE,MRP_ELEMNT,ELEMNT_DATA,EXCMSGKEY,EXCMESSAGE,REC_REQD_QTY,AVAIL_QTY1,AVAIL_QTY2,ATP_QTY,FBYTE,SELECTION,EXCEP_IND,PROD_VERSION,BOMEXPL_NO,REV_LEV,SCRAP,START_DATE,OPEN_DATE,SPPROCTYPE,EXT_SPPROCTYPE,PLAN_PLANT1,PLAN_PLANT2,STG_LOC_2,STORAGE_LOC,RESCHED_DATE,VENDOR_NO,CUSTOMER,CUST_NAME,VEND_NAME,LOW_LEVEL_EXCPT,STOCK_IN_TRANSIT,USER_EXIT1,USER_EXIT2,USER_EXIT3,SORTIND_KD,REC_REQD_QTY_ALT_UOM,AVAIL_QTY_ALT_UOM,TEXT_FIELD_ALT_UOM,ICON_TEXT,CRM_ID,VKORG,UNNEG) select t.KEY_ID,t.BUKRS,t.MATNR,t.WERKS,t.ORDEN,t.PLNGSEGMT,t.PLNGSEGNO,t.SORT_DATE,t.SORTIND_00,t.SORTIND_01,t.SORTIND_02,t.MRP_ELEMENT_IND,t.PLUS_MINUS,t.AVAILABLE,t.AVAIL_DATE,t.FINISH_DATE,t.MRP_ELEMNT,t.ELEMNT_DATA,t.EXCMSGKEY,t.EXCMESSAGE,t.REC_REQD_QTY,t.AVAIL_QTY1,t.AVAIL_QTY2,t.ATP_QTY,t.FBYTE,t.SELECTION,t.EXCEP_IND,t.PROD_VERSION,t.BOMEXPL_NO,t.REV_LEV,t.SCRAP,t.START_DATE,t.OPEN_DATE,t.SPPROCTYPE,t.EXT_SPPROCTYPE,t.PLAN_PLANT1,t.PLAN_PLANT2,t.STG_LOC_2,t.STORAGE_LOC,t.RESCHED_DATE,t.VENDOR_NO,t.CUSTOMER,t.CUST_NAME,t.VEND_NAME,t.LOW_LEVEL_EXCPT,t.STOCK_IN_TRANSIT,t.USER_EXIT1,t.USER_EXIT2,t.USER_EXIT3,t.SORTIND_KD,t.REC_REQD_QTY_ALT_UOM,t.AVAIL_QTY_ALT_UOM,t.TEXT_FIELD_ALT_UOM,t.ICON_TEXT,t.CRM_ID,t.VKORG,t.UNNEG from flujo_crm_tmp as t left join flujo_crm_todo as p on p.MATNR=t.MATNR AND p.BUKRS=t.BUKRS AND p.WERKS=t.WERKS AND p.ORDEN=t.ORDEN where p.id is null";
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					echo "ERROR::".$sql."||".$e."\r\n";
					throw ($e);
				}		
							
				
				
				$sql = "update flujo_crm_todo as p JOIN (select MATNR, BUKRS, WERKS, MAX(ORDEN) as maxorden from flujo_crm_tmp GROUP BY MATNR, BUKRS, WERKS) as t on
			(t.matnr = p.matnr and t.bukrs = p.bukrs and t.werks = p.werks) set p.estado='INACTIVO'  where t.maxorden < p.orden";
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					echo "ERROR::".$sql."||".$e."\r\n";
					throw ($e);
				}		
							
			
				$sql = "update flujo_crm_todo as p JOIN (select MATNR, BUKRS, WERKS, MAX(ORDEN) as maxorden from flujo_crm_tmp GROUP BY MATNR, BUKRS, WERKS) as t on
			(t.matnr = p.matnr and t.bukrs = p.bukrs and t.werks = p.werks) set p.estado='ACTIVO'  where t.maxorden >= p.orden";
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					echo "ERROR::".$sql."||".$e."\r\n";
					throw ($e);
				}		
						
		/**/
					$sql_ok = true; 
				$sql = "COMMIT";     
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					echo "ERROR::".$sql."||".$e."\r\n";
					throw ($e);
				}
			} catch (Exception $e) {
				$sql = "ROLLBACK";  
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					echo "ERROR::".$sql."||".$e."\r\n";
					$serv->pongo_hayError($sql."||".$e);
				}
				
			}	
		
	}
	unset ($lista_actu_flujo,$actu_flujo,$af);
	
	
	
		
	
?>