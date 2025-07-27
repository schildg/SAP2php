<?php



$sql_ok = true; 
$sql = "TRUNCATE TABLE `ppendientes_crm_tmp`";       //borro todo los pedidos de la tabla tremporal
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}

/*	$sql="DELETE FROM ppendientes_crm WHERE date_concurrency <= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
	try { //BORRAMOS TODAS LAS NOVEDADES CON MAS DE UNA HORA
		MyActiveRecord :: Query($sql);
	} catch (Exception $e) {
		$serv->pongo_hayError($sql."||".$e);
		$sql_ok = false;
	}*/

/***************************************************************************************************
 *                          AR20
 ***************************************************************************************************/

	$serv->set_subestado("iniciando proceso ZIF_PEDIDOS_VENTA2(AR20)");
	$fce = saprfc_function_discover($rfc,"ZIF_PEDIDOS_VENTA2");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_PEDIDOS_VENTA2"); exit; }

	saprfc_import ($fce,"BUKRS","AR20");
//	saprfc_import ($fce,"FECHA_DESDE",$fecha_inicio);
	saprfc_import ($fce,"FECHA_DESDE",'20140101');
	saprfc_import ($fce,"FECHA_HASTA",$fecha_fin);
	saprfc_import ($fce,"RUTA","");
	saprfc_import ($fce,"TIPO","");
	//Fill internal tables
	saprfc_table_init ($fce,"EX_PEDIDOSVENTA");
			//Do RFC call of function ZIF_PEDIDOS_VENTA, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZIF_PEDIDOS_VENTA2(AR20)");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"EX_PEDIDOSVENTA");
	for ($i=1;$i<=$rows;$i++)
		$EX_PEDIDOSVENTA[] = saprfc_table_read ($fce,"EX_PEDIDOSVENTA",$i);
		//Debug info

	foreach ($EX_PEDIDOSVENTA as $vta) {
		$pventa = new PPendientes_CRM_TMP();
		foreach ($vta as $k =>$v){
				$pventa->$k = $vta[$k];
			}	
		$pventa->NETPR=$vta[TOTAL_PESO];	
		$pventa->NETPR_USD=$vta[TOTAL_DOLAR];	
		$pventa->PU_ML=$vta[PRECIO_PESO];	
		$pventa->PU_USD=$vta[PRECIO_DOLAR];	
		$pventa->save();
		if (!$serv->is_running()){exit;}
	}

	saprfc_function_free($fce);
	unset($pventa,$EX_PEDIDOSVENTA,$vta,$fce,$rfc_rc);
/***************************************************************************************************
 *                          PE10
 ***************************************************************************************************/
	$serv->set_subestado("iniciando proceso ZIF_PEDIDOS_VENTA2(PE10)");
	$fce = saprfc_function_discover($rfc,"ZIF_PEDIDOS_VENTA2");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_PEDIDOS_VENTA2"); exit; }

	saprfc_import ($fce,"BUKRS","PE10");
//	saprfc_import ($fce,"FECHA_DESDE",$fecha_inicio);
	saprfc_import ($fce,"FECHA_DESDE",'20130101');
	saprfc_import ($fce,"FECHA_HASTA",$fecha_fin);
	saprfc_import ($fce,"RUTA","");
	saprfc_import ($fce,"TIPO","");
	//Fill internal tables
	saprfc_table_init ($fce,"EX_PEDIDOSVENTA");
			//Do RFC call of function ZIF_PEDIDOS_VENTA, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZIF_PEDIDOS_VENTA2(PE10)");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"EX_PEDIDOSVENTA");
	for ($i=1;$i<=$rows;$i++)
		$EX_PEDIDOSVENTA[] = saprfc_table_read ($fce,"EX_PEDIDOSVENTA",$i);
		//Debug info
		
	foreach ($EX_PEDIDOSVENTA as $vta) {
		$pventa = new PPendientes_CRM_TMP();
		foreach ($vta as $k =>$v){
				$pventa->$k = $vta[$k];
			}	
		$pventa->NETPR=$vta[TOTAL_PESO];	
		$pventa->NETPR_USD=$vta[TOTAL_DOLAR];	
		$pventa->PU_ML=$vta[PRECIO_PESO];	
		$pventa->PU_USD=$vta[PRECIO_DOLAR];	
		$pventa->save();
		if (!$serv->is_running()){exit;}
	}
	saprfc_function_free($fce);
	unset($pventa,$EX_PEDIDOSVENTA,$vta,$fce,$rfc_rc);
	
/***************************************************************************************************
 *                          TODO
 ***************************************************************************************************/
	$serv->set_subestado("iniciando proceso ZIF_PEDIDOS_VENTA2(SQL)");
	if (!$serv->is_running()){exit;}

	$sql = "START TRANSACTION";
	try {
		MyActiveRecord :: Query($sql);		
		$sql = "INSERT IGNORE INTO STOCK_CRM_TODO (BUKRS,WERKS,LGORT,MATNR) SELECT BUKRS,WERKS,LGORT,MATNR FROM `ppendientes_crm_todo` AS P WHERE LGORT!='' AND WERKS!='' AND MATNR!='' and  `AUART` <> 'ZCE1' AND LFSTA <> 'Tratado Completamente' GROUP BY BUKRS,WERKS,LGORT,MATNR";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
		$sql = "INSERT IGNORE INTO STOCK_CRM_TMP (BUKRS,WERKS,LGORT,MATNR) SELECT BUKRS,WERKS,LGORT,MATNR FROM `ppendientes_crm_todo` AS P WHERE LGORT!='' AND WERKS!='' AND MATNR!='' and  `AUART` <> 'ZCE1' AND LFSTA <> 'Tratado Completamente' GROUP BY BUKRS,WERKS,LGORT,MATNR";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
		
		
		$sql = "update ppendientes_crm_tmp  set LFSTA='Tratado Completamente' where AUART like '%ZNC%'";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
		
		$sql = "update ppendientes_crm_todo as p left join ppendientes_crm_tmp as t on p.bukrs=t.bukrs and p.auart=t.auart and p.vbeln=t.vbeln and p.posnr=t.posnr and p.etenr=t.etenr set p.KEY_ID=t.KEY_ID,p.BUKRS=t.BUKRS,p.CRM_ID=t.CRM_ID,p.AUART=t.AUART,p.VBELN=t.VBELN,p.POSNR=t.POSNR,p.ETENR=t.ETENR,p.VKORG=t.VKORG,p.UNNEG=t.UNNEG,p.VTWEG=t.VTWEG,p.AUDAT=t.AUDAT,p.VDATU=t.VDATU,p.KUNNR=t.KUNNR,p.KUNN2=t.KUNN2,p.LAND1=t.LAND1,p.MATNR=t.MATNR,p.WERKS=t.WERKS,p.LGORT=t.LGORT,p.KWMENG=t.KWMENG,p.ZIEME=t.ZIEME,p.WAERK=t.WAERK,p.STCUR=t.STCUR,p.NETPR=t.NETPR,p.NETPR_USD=t.NETPR_USD,p.PU_ML=t.PU_ML,p.PU_USD=t.PU_USD,p.RFSTA=t.RFSTA,p.LSSTA=t.LSSTA,p.GBSTA=t.GBSTA,p.LFSTA=t.LFSTA,p.BSTNK=t.BSTNK,p.BSTCL=t.BSTCL,p.BSARK=t.BSARK  where t.id is not null";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
		
		$sql = "insert into ppendientes_crm_todo (KEY_ID,BUKRS,CRM_ID,AUART,VBELN,POSNR,ETENR,VKORG,UNNEG,VTWEG,AUDAT,VDATU,KUNNR,KUNN2,LAND1,MATNR,WERKS,LGORT,KWMENG,ZIEME,WAERK,STCUR,NETPR,NETPR_USD,PU_ML,PU_USD,RFSTA,LSSTA,GBSTA,LFSTA,BSTNK,BSTCL,BSARK) select t.KEY_ID,t.BUKRS,t.CRM_ID,t.AUART,t.VBELN,t.POSNR,t.ETENR,t.VKORG,t.UNNEG,t.VTWEG,t.AUDAT,t.VDATU,t.KUNNR,t.KUNN2,t.LAND1,t.MATNR,t.WERKS,t.LGORT,t.KWMENG,t.ZIEME,t.WAERK,t.STCUR,t.NETPR,t.NETPR_USD,t.PU_ML,t.PU_USD,t.RFSTA,t.LSSTA,t.GBSTA,t.LFSTA,t.BSTNK,t.BSTCL,t.BSARK from ppendientes_crm_tmp as t left join ppendientes_crm_todo as p on p.bukrs=t.bukrs and p.auart=t.auart and p.vbeln=t.vbeln and p.posnr=t.posnr and p.etenr=t.etenr where p.id is null";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
		
		
		$sql = "update ppendientes_crm_todo as p left join ppendientes_crm_tmp as t on p.bukrs=t.bukrs and p.auart=t.auart and p.vbeln=t.vbeln and p.posnr=t.posnr and p.etenr=t.etenr set p.LFSTA='Tratado Completamente' where t.id is null";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
			
		$sql_ok = true; 
		$sql = "update stock_crm_todo as s left join (SELECT MATNR, WERKS, LGORT, sum(KWMENG) as KWMENG1  FROM `ppendientes_crm_todo` WHERE `AUART` <> 'ZCE1' AND LFSTA <> 'Tratado Completamente'
		GROUP BY MATNR, WERKS, LGORT) as p ON s.matnr=p.matnr and s.werks=p.werks and s.lgort=p.lgort set s.reserv=if(p.matnr is null,0,p.KWMENG1)"; // actualizo la cantidad de pedidos pendientes
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
	
	
	
?>