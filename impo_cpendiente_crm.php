<?php



$sql_ok = true; 
$sql = "TRUNCATE TABLE `cpendientes_crm_tmp`";       //borro todo los pedidos de la tabla tremporal
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}

/*$sql="DELETE FROM cpendientes_crm WHERE date_concurrency <= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
try { //BORRAMOS TODAS LAS NOVEDADES CON MAS DE UNA HORA
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}*/


/*********************************************************************************************************
 * 
 *        ARGENTINA
 * 
 *********************************************************************************************************/	
	

	$serv->set_subestado("iniciando proceso ZIF_PEDIDOS_COMPRA2(AR20)");
	$fce = saprfc_function_discover($rfc,"ZIF_PEDIDOS_COMPRA2");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_PEDIDOS_COMPRA2"); exit; }

	saprfc_import ($fce,"BUKRS","AR20");
//	saprfc_import ($fce,"FECHA_DESDE",$fecha_inicio);
	saprfc_import ($fce,"FECHA_DESDE",'20140101');
	saprfc_import ($fce,"FECHA_HASTA",$fecha_fin);
	saprfc_import ($fce,"RUTA","");
	saprfc_import ($fce,"TIPO","");
	//Fill internal tables
	saprfc_table_init ($fce,"EX_PEDIDOSCOMPRAS");
			//Do RFC call of function ZIF_PEDIDOS_COMPRA2, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZIF_PEDIDOS_COMPRA2(AR20)");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"EX_PEDIDOSCOMPRAS");
	for ($i=1;$i<=$rows;$i++)
		$EX_PEDIDOSCOMPRAS[] = saprfc_table_read ($fce,"EX_PEDIDOSCOMPRAS",$i);
		//Debug info
		
	foreach ($EX_PEDIDOSCOMPRAS as $cmp) {
		$pcompra = new CPendientes_CRM_TMP();
		foreach ($cmp as $k =>$v){
				$pcompra->$k = $cmp[$k];
			}	
		$pcompra->save();
		if (!$serv->is_running()){exit;}
	}

	saprfc_function_free($fce);
	unset($pcompra,$EX_PEDIDOSCOMPRAS,$cmp,$fce,$rfc_rc);
	
/*********************************************************************************************************
 * 
 *                     PERU
 * 
 *********************************************************************************************************/	
	
	$serv->set_subestado("iniciando proceso ZIF_PEDIDOS_COMPRA2(PE10)");
	$fce = saprfc_function_discover($rfc,"ZIF_PEDIDOS_COMPRA2");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_PEDIDOS_COMPRA2"); exit; }

	saprfc_import ($fce,"BUKRS","PE10");
//	saprfc_import ($fce,"FECHA_DESDE",$fecha_inicio);
	saprfc_import ($fce,"FECHA_DESDE",'20120101');
	saprfc_import ($fce,"FECHA_HASTA",$fecha_fin);
	saprfc_import ($fce,"RUTA","");
	saprfc_import ($fce,"TIPO","");
	//Fill internal tables
	saprfc_table_init ($fce,"EX_PEDIDOSCOMPRAS");
			//Do RFC call of function ZIF_PEDIDOS_COMPRA2, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZIF_PEDIDOS_COMPRA2(PE10)");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"EX_PEDIDOSCOMPRAS");
	for ($i=1;$i<=$rows;$i++)
		$EX_PEDIDOSCOMPRAS[] = saprfc_table_read ($fce,"EX_PEDIDOSCOMPRAS",$i);
		//Debug info
		
	foreach ($EX_PEDIDOSCOMPRAS as $cmp) {
		$pcompra = new CPendientes_CRM_TMP();
		foreach ($cmp as $k =>$v){
				$pcompra->$k = $cmp[$k];
			}	
		$pcompra->save();
		if (!$serv->is_running()){exit;}
	}

	saprfc_function_free($fce);
	unset($pcompra,$EX_PEDIDOSCOMPRAS,$cmp,$fce,$rfc_rc);
	
	
	
/*********************************************************************************************************
 * 
 *        parte COMUN A TODOS LOS PROCESOS
 * 
 *********************************************************************************************************/	
	
	$serv->set_subestado("iniciando proceso ZIF_PEDIDOS_COMPRA2(SQL)");
	
	
	if (!$serv->is_running()){exit;}

	$sql = "START TRANSACTION";
	try {
		MyActiveRecord :: Query($sql);
		
		$sql = "INSERT IGNORE INTO STOCK_CRM_TODO (BUKRS,WERKS,LGORT,MATNR) SELECT BUKRS,WERKS,LGORT,MATNR FROM `cpendientes_crm_todo` AS P WHERE LGORT!='' AND WERKS!='' AND MATNR!='' AND ESTADO <> 'Ingresada' GROUP BY BUKRS,WERKS,LGORT,MATNR";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
		
		$sql = "INSERT IGNORE INTO STOCK_CRM_TMP (BUKRS,WERKS,LGORT,MATNR) SELECT BUKRS,WERKS,LGORT,MATNR FROM `cpendientes_crm_todo` AS P WHERE ESTADO <> 'Ingresada' and LGORT!='' AND WERKS!='' AND MATNR!='' GROUP BY BUKRS,WERKS,LGORT,MATNR";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
		
		
				
		$sql = "update cpendientes_crm_todo as p left join cpendientes_crm_tmp as t on p.BUKRS=t.BUKRS and p.EEIND=t.EEIND and p.EBELN=t.EBELN and p.EBELP=t.EBELP and p.BSART=t.BSART and p.LIFNR=t.LIFNR and p.MATNR=t.MATNR set p.KEY_ID=t.KEY_ID,p.BUKRS=t.BUKRS,p.CRM_ID=t.CRM_ID,p.EBELN=t.EBELN,p.EBELP=t.EBELP,p.EKORG=t.EKORG,p.EKGRP=t.EKGRP,p.BSART=t.BSART,p.AEDAT=t.AEDAT,p.EEIND=t.EEIND,p.LIFNR=t.LIFNR,p.MATNR=t.MATNR,p.WERKS=t.WERKS,p.LGORT=t.LGORT,p.MENGE=t.MENGE,p.MEINS=t.MEINS,p.WAERS=t.WAERS,p.WKURS=t.WKURS,p.CU_PESO=t.CU_PESO,p.CU_DOLAR=t.CU_DOLAR,p.COSTO_PESO=t.COSTO_PESO,p.COSTO_DOLAR=t.COSTO_DOLAR,p.COSTO_NAC_PESO=t.COSTO_NAC_PESO/t.MENGE,p.COSTO_NAC_DOLAR=t.COSTO_NAC_DOLAR/t.MENGE,p.ESTADO=t.ESTADO where t.id is not null";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
		
		$sql = "insert into cpendientes_crm_todo (KEY_ID,BUKRS,CRM_ID,EBELN,EBELP,EKORG,EKGRP,BSART,AEDAT,EEIND,LIFNR,MATNR,WERKS,LGORT,MENGE,MEINS,WAERS,WKURS,CU_PESO,CU_DOLAR,COSTO_PESO,COSTO_DOLAR,COSTO_NAC_PESO, COSTO_NAC_DOLAR,ESTADO) select t.KEY_ID,t.BUKRS,t.CRM_ID,t.EBELN,t.EBELP,t.EKORG,t.EKGRP,t.BSART,t.AEDAT,t.EEIND,t.LIFNR,t.MATNR,t.WERKS,t.LGORT,t.MENGE,t.MEINS,t.WAERS,t.WKURS,t.CU_PESO,t.CU_DOLAR,t.COSTO_PESO,t.COSTO_DOLAR,t.COSTO_NAC_PESO/t.MENGE AS COSTO_NAC_PESO,t.COSTO_NAC_DOLAR/t.MENGE AS COSTO_NAC_DOLAR,t.ESTADO from cpendientes_crm_tmp as t left join cpendientes_crm_todo as p on p.BUKRS=t.BUKRS and  p.EEIND=t.EEIND and p.EBELN=t.EBELN and p.EBELP=t.EBELP and p.BSART=t.BSART and p.LIFNR=t.LIFNR and p.MATNR=t.MATNR where p.id is null";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
		
		
		$sql = "update cpendientes_crm_todo as p left join cpendientes_crm_tmp as t on p.BUKRS=t.BUKRS and p.EEIND=t.EEIND and p.EBELN=t.EBELN and p.EBELP=t.EBELP and p.BSART=t.BSART and p.LIFNR=t.LIFNR and p.MATNR=t.MATNR set p.ESTADO='Ingresada' where t.id is null";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
			
		$sql_ok = true; 
		$sql = "update stock_crm_todo as s left join (SELECT MATNR, WERKS, LGORT, sum(MENGE) as MENGE1  FROM `cpendientes_crm_todo` WHERE ESTADO <> 'Ingresada'
		GROUP BY MATNR, WERKS, LGORT) as p ON s.matnr=p.matnr and s.werks=p.werks and s.lgort=p.lgort set s.reserventre=if(p.matnr is null,0,p.MENGE1)"; // actualizo la cantidad de pedidos pendientes
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
				
		$sql_ok = true; 
		$sql = "update stock_crm_todo s  left join stock_crm_tmp s1   on s.matnr = s1.matnr and s.werks = s1.werks and s.lgort=s1.lgort
		  set s.labst = 0,s.INSME=0,s.RESERV=0,s.RESERVENTRE=0,s.CURSO=0,s.TRANSITO=0  where s1.matnr is null";       //borro todo el stock
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
			
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