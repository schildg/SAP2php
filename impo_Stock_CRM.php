<?php
	
/************************************************************************************
 *     A CONTINUACION SE TRATAN LOS MATERIALES
 * 
 ************************************************************************************/

$serv->set_subestado("borro datos de stock");

$sql_ok = true; 
$sql = "TRUNCATE TABLE `stock_crm_tmp`";       //borro todo el stock
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}
$timestamp1 = mktime(0, 0, 0,  date("m"), date("d"), date("Y"))-(60*60*24*30*1); //seis meses para atras
$periodo_contable   =  date("Y",$timestamp1);
//echo $periodo_contable."\r\n";

/*$sql="DELETE FROM existencia_material WHERE date_concurrency <= DATE_SUB(NOW(), INTERVAL 1 HOUR) ";
try { //BORRAMOS TODAS LAS NOVEDADES CON MAS DE UNA HORA
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}
$sql="DELETE FROM stock_crm WHERE date_concurrency <= DATE_SUB(NOW(), INTERVAL 1 HOUR) ";
try { //BORRAMOS TODAS LAS NOVEDADES CON MAS DE UNA HORA
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}*/

/***************************************************************************************************
 *                          AR20
 ***************************************************************************************************/
$serv->set_subestado("iniciando proceso ZIF_STOCK(AR20)");
$fce = saprfc_function_discover($rfc,"ZIF_STOCK");
if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_STOCK"); exit; }
saprfc_import ($fce,"BUKRS","AR20");
saprfc_import ($fce,"BDATJ",$periodo_contable);
saprfc_import ($fce,"RUTA","");
saprfc_import ($fce,"TIPO","");
//Fill internal tables
saprfc_table_init ($fce,"EX_STOCK");

$rfc_rc = saprfc_call_and_receive ($fce);
if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_secue("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError (saprfc_error($fce)); exit; }
//Retrieve export parameters
$rows = saprfc_table_rows ($fce,"EX_STOCK");
for ($i=1;$i<=$rows;$i++)
	$EX_STOCK[] = saprfc_table_read ($fce,"EX_STOCK",$i);
//Debug info
	$serv->set_subestado("procesando respuesta ZIF_STOCK(AR20)");
foreach ($EX_STOCK as $stk) {
	$stock_tmp = new Stock_CRM_tmp();
	foreach ($stk as $k =>$v){
			$stock_tmp->$k = $stk[$k];
	}
	$stock_tmp->BUKRS='AR20';	
	$stock_tmp->save();
	if (!$serv->is_running()){exit;}		
}

saprfc_function_free($fce);
unset($stock_tmp,$EX_STOCK,$stk,$fce,$rfc_rc);

/***************************************************************************************************
 *                          PE10
 ***************************************************************************************************/
$serv->set_subestado("iniciando proceso ZIF_STOCK(PE10)");
$fce = saprfc_function_discover($rfc,"ZIF_STOCK");
if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_STOCK"); exit; }
saprfc_import ($fce,"BUKRS","PE10");
saprfc_import ($fce,"BDATJ",$periodo_contable);
saprfc_import ($fce,"RUTA","");
saprfc_import ($fce,"TIPO","");
//Fill internal tables
saprfc_table_init ($fce,"EX_STOCK");

$rfc_rc = saprfc_call_and_receive ($fce);
if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_secue("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError (saprfc_error($fce)); exit; }
//Retrieve export parameters
$rows = saprfc_table_rows ($fce,"EX_STOCK");
for ($i=1;$i<=$rows;$i++)
	$EX_STOCK[] = saprfc_table_read ($fce,"EX_STOCK",$i);
//Debug info
	$serv->set_subestado("procesando respuesta ZIF_STOCK(PE10)");
foreach ($EX_STOCK as $stk) {
	$stock_tmp = new Stock_CRM_tmp();
	foreach ($stk as $k =>$v){
			$stock_tmp->$k = $stk[$k];
	}	
	$stock_tmp->BUKRS='PE10';	
	$stock_tmp->save();
	if (!$serv->is_running()){exit;}		
}

saprfc_function_free($fce);
unset($stock_tmp,$EX_STOCK,$stk,$fce,$rfc_rc);

/***************************************************************************************************
 *                          TODO
 ***************************************************************************************************/

$serv->set_subestado("procesando respuestas ZIF_STOCK(SQL)");

	$sql = "START TRANSACTION";
	try {
		
		MyActiveRecord :: Query($sql);

		$sql = "INSERT IGNORE INTO STOCK_CRM_TODO (BUKRS,WERKS,LGORT,MATNR) SELECT BUKRS,WERKS,LGORT,MATNR FROM stock_crm_tmp AS P WHERE LGORT!='' AND WERKS!='' AND MATNR!='' GROUP BY BUKRS,WERKS,LGORT,MATNR";       //nuevo stock
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
				
		$sql_ok = true; 
		$sql = "update stock_crm_todo as s left join stock_crm_tmp as t on t.matnr=s.matnr and t.werks=s.werks and t.lgort=s.lgort set s.labst=if(t.matnr is null,0,t.labst), s.insme=if(t.matnr is null,0,t.insme), s.curso=if(t.matnr is null,0,t.curso), s.transito=if(t.matnr is null,0,t.transito), s.cu=if(t.matnr is null,s.cu,t.cu), s.cu_usd=if(t.matnr is null,s.cu_usd,t.cu_usd)";
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
	

$reg_ult_act = new Actualizacion_CRM("Stock_CRM");
$reg_ult_act->save();



?>
