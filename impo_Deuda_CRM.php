<?php
	
/************************************************************************************
 *     A CONTINUACION SE TRATAN LOS MATERIALES
 * 
 ************************************************************************************/
/*$sql="DELETE FROM deuda_crm WHERE date_concurrency <= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
try { //BORRAMOS TODAS LAS NOVEDADES CON MAS DE UNA HORA
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}

$sql="DELETE FROM factura_crm WHERE date_concurrency <= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
try { //BORRAMOS TODAS LAS NOVEDADES CON MAS DE UNA HORA
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
//	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}*/

$sql_ok = true; 
$sql = "TRUNCATE TABLE `deuda_crm_tmp`";       //borro toda la deuda
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}

$timestamp1 = mktime(0, 0, 0,  date("m"), date("d"), date("Y"));
$fecha_fin_DEU    =  date("Ymd",$timestamp1);

/***************************************************************************************************
 *                          AR20
 ***************************************************************************************************/
$serv->set_subestado("iniciando proceso ZIF_DEUDA(AR20)");
$fce = saprfc_function_discover($rfc,"ZIF_DEUDA");
if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_DEUDA"); exit; }
saprfc_import ($fce,"BUKRS","AR20");
saprfc_import ($fce,"FECHA_DESDE","20000101");
saprfc_import ($fce,"FECHA_HASTA",$fecha_fin_DEU);
saprfc_import ($fce,"RUTA","");
saprfc_import ($fce,"TIPO","");
//Fill internal tables
saprfc_table_init ($fce,"EX_DEUDA");
$serv->set_subestado("procesando ejecucion ZIF_DEUDA(AR20)");
$rfc_rc = saprfc_call_and_receive ($fce);
if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_secue("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError (saprfc_error($fce)); exit; }
//Retrieve export parameters
$rows = saprfc_table_rows ($fce,"EX_DEUDA");
for ($i=1;$i<=$rows;$i++)
	$EX_DEUDA[] = saprfc_table_read ($fce,"EX_DEUDA",$i);
//Debug info
$serv->set_subestado("procesando respuesta ZIF_DEUDA(AR20)");
foreach ($EX_DEUDA as $deu) {
	$deuda = new Deuda_CRM_TMP();
	foreach ($deu as $k =>$v){
			$deuda->$k = $deu[$k];
		}	
	$deuda->save();
	if (!$serv->is_running()){exit;}		
}

saprfc_function_free($fce);

unset($deuda,$EX_DEUDA,$deu,$rows,$rfc_rc,$fce);
/***************************************************************************************************
 *                          PE10
 ***************************************************************************************************/
$serv->set_subestado("iniciando proceso ZIF_DEUDA(PE10)");
$fce = saprfc_function_discover($rfc,"ZIF_DEUDA");
if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_DEUDA"); exit; }
saprfc_import ($fce,"BUKRS","PE10");
saprfc_import ($fce,"FECHA_DESDE","20000101");
saprfc_import ($fce,"FECHA_HASTA",$fecha_fin_DEU);
saprfc_import ($fce,"RUTA","");
saprfc_import ($fce,"TIPO","");
//Fill internal tables
saprfc_table_init ($fce,"EX_DEUDA");
$serv->set_subestado("procesando ejecucion ZIF_DEUDA(PE10)");
$rfc_rc = saprfc_call_and_receive ($fce);
if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_secue("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError (saprfc_error($fce)); exit; }
//Retrieve export parameters
$rows = saprfc_table_rows ($fce,"EX_DEUDA");
for ($i=1;$i<=$rows;$i++)
	$EX_DEUDA[] = saprfc_table_read ($fce,"EX_DEUDA",$i);
//Debug info
$serv->set_subestado("procesando respuesta ZIF_DEUDA(PE10)");
foreach ($EX_DEUDA as $deu) {
	$deuda = new Deuda_CRM_TMP();
	foreach ($deu as $k =>$v){
			$deuda->$k = $deu[$k];
		}	
	$deuda->save();
	if (!$serv->is_running()){exit;}		
}

saprfc_function_free($fce);

unset($deuda,$EX_DEUDA,$deu,$rows,$rfc_rc,$fce);
/***************************************************************************************************
 *                          TODO
 ***************************************************************************************************/
$serv->set_subestado("procesando respuesta ZIF_DEUDA(SQL)");

	$sql = "START TRANSACTION";
	try {
		MyActiveRecord :: Query($sql);
		$sql = "insert into deuda_crm_todo (FKART,VBELN,BLART,BUKRS,BELNR,GJAHR,XBLNR,WAERK,VKORG,VTWEG,FKDAT,KURRF,ZTERM,CRM_ID,FKVEN,FKREC,KUNNR,DIATR,KUNN2,UNNEG,DMBTR,DMBE2,SABTR,SABE2) select '' as FKART,
		CONCAT(d.BUKRS,d.BELNR,d.GJAHR) as VBELN,
		d.BLART as BLART,
		d.BUKRS as BUKRS,
		d.BELNR as BELNR,
		d.GJAHR as GJAHR,
		d.XBLNR as XBLNR,
		d.WAERK as WAERK,
		(@VKOR_VAR:=if(crt.vkorg is null,crk.vkorg,d.VKORG)) as VKORG,
		d.VTWEG as VTWEG,
		d.ZFBDT as FKDAT,
		d.KURRF as KURRF,
		d.ZTERM as ZTERM,
		CONCAT(d.kunnr,@VKOR_VAR) as CRM_ID,
		'' as FKVEN,
		'' as FKREC,
		d.KUNNR as KUNNR,
		0 as DIATR,
		CONCAT('000',CONVERT(d.KUNN2,UNSIGNED INTEGER)) as KUNN2,
		IF (@VKOR_VAR=2010 or @VKOR_VAR=1010,'Feed',IF (@VKOR_VAR=2020 or @VKOR_VAR=1020,'Food',IF (@VKOR_VAR=2030 or @VKOR_VAR=1030,'Industrial','Otros'))) as UNNEG,
		sum(d.dmbtr) as DMBTR,
		sum(d.dmbe2) as DMBE2,
		IF (d.SHKZG='H',sum(d.dmbtr)*-1,sum(d.dmbtr) ) as SABTR,
		IF (d.SHKZG='H',sum(d.dmbe2)*-1,sum(d.dmbe2) ) as SABE2
		 from deuda_crm_tmp as d left join deuda_crm_todo as f on d.belnr=f.belnr and d.bukrs=f.bukrs and d.gjahr=f.gjahr
		 left join cliente_crm_todo as crt on crt.bukrs=d.bukrs and crt.kunnr=d.kunnr and crt.vkorg=d.vkorg
		 left join (select bukrs,kunnr,vkorg from cliente_crm_todo where ticl!='Proveedor'group by bukrs,kunnr) as crk on d.bukrs=crk.bukrs and d.kunnr=crk.kunnr where f.blart is null group by d.bukrs,d.belnr,d.gjahr";
		
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
							
		 
		
		
		$sql = "update deuda_crm_todo as d left join (select kunnr,belnr,gjahr,bukrs,sum(sdmbe2) sdmbe2,sum(sdmbtr) as sdmbtr from (select b.bukrs,if(a.belnr is null,b.belnr,b.rebzg) as belnr,if(a.gjahr is null,b.gjahr,b.rebzj) as gjahr,b.kunnr,sum(if(b.SHKZG='H',b.dmbe2*-1,b.dmbe2)) as sdmbe2,sum(if(b.SHKZG='H',b.dmbtr*-1,b.dmbtr)) as sdmbtr from deuda_crm_tmp as b left join deuda_crm_tmp as a on a.buzei=b.buzei and a.kunnr=b.kunnr and a.belnr=b.rebzg and b.rebzj=a.gjahr and a.bukrs=b.bukrs left join deuda_crm_todo as c on c.belnr=b.rebzg and b.rebzj=c.gjahr and c.bukrs=b.bukrs and b.kunnr=c.kunnr  group by b.rebzg,b.rebzj,b.bukrs) as h group by h.belnr,h.bukrs,h.gjahr ) as f on d.belnr=f.belnr and d.gjahr=f.gjahr and d.bukrs=f.bukrs
		set 		d.sabe2=if(f.sdmbe2 is null,0,f.sdmbe2),d.sabtr=if(f.sdmbtr is null,0,f.sdmbtr)";       //actualizo la deuda
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}

		 
/*		$sql = "update deuda_crm_todo as d left join deuda_crm_tmp as t on t.bukrs=d.bukrs and t.belnr=d.belnr and t.gjahr=d.gjahr set d.sabe2=0,d.sabtr=0 where t.id is null and d.sabe2<>0";       //actualizo la deuda
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
*/		
		
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
			
	
	$venta= New Deuda_CRM_TODO();
	$venta= $venta->FindAll('Deuda_CRM_TODO', "FKVEN=''");
	foreach ($venta as $vt){
		$vt->save();
	}
	
	
	$reg_ult_act = new Actualizacion_CRM("Deuda_CRM");
	$reg_ult_act->save();

				
?>
