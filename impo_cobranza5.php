<?php
	
/***************************************************************************************************************
 * *************************************************************************************************************
 * *
 * *          ACA EMPIEZA EL TRATAMIENTO DE PENDIENTES
 * *
 * *************************************************************************************************************
 ***************************************************************************************************************/



$sql_ok = true; 
$sql = "TRUNCATE TABLE `cobranza5_bseclr_crm_tmp`";       //borro toda la cobranza temporal
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}

$sql_ok = true; 
$sql = "TRUNCATE TABLE `cobranza5_bseg_crm_tmp`";       //borro toda la cobranza temporal
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}

$sql_ok = true; 
$sql = "TRUNCATE TABLE `cobranza5_cab_crm_tmp`";       //borro toda la cobranza temporal
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}

$sql_ok = true; 
$sql = "TRUNCATE TABLE `cobranza5_cheque_crm_tmp`";       //borro toda la cobranza temporal
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}

/************************************************************************************
 *     A CONTINUACION SE TRATA COBRANZAS DE ARGENTINA
 * 
 ************************************************************************************/

$periodo_contable   =  date("Y",strtotime($fecha_inicio));
//echo $periodo_contable."\r\n";

	$serv->set_subestado("iniciando proceso ZFI_COBRANZA5(AR20) $fecha_fin_cobranza");
	$fce = saprfc_function_discover($rfc,"ZFI_COBRANZA5");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZFI_COBRANZA5"); exit; }

	saprfc_import ($fce,"SOCIEDAD","AR20");
	saprfc_import ($fce,"EJERCICIO",$periodo_contable);
	//	saprfc_import ($fce,"FECHA_DESDE",$fecha_inicio);
	saprfc_import ($fce,"FECHA_DESDE",$fecha_ini_cobranza);
	saprfc_import ($fce,"FECHA_HASTA",$fecha_fin_cobranza);
	saprfc_import ($fce,"RUTA","");
	saprfc_import ($fce,"TIPO","");
	//Fill internal tables

	saprfc_table_init ($fce,"ZSFI_COBRANZA5_BSEG");
	saprfc_table_init ($fce,"ZSFI_COBRANZA5_BSE_CLR");
	saprfc_table_init ($fce,"ZSFI_COBRANZA5_CAB");
	saprfc_table_init ($fce,"ZSFI_COBRANZA5_CHEQUE");
	//Do RFC call of function ZFI_COBRANZA, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZFI_COBRANZA5(AR20)");
	//Retrieve export parameters

	
	$rows = saprfc_table_rows ($fce,"ZSFI_COBRANZA5_BSEG");
	for ($i=1;$i<=$rows;$i++)
		$ZSFI_COBRANZA5_BSEG[] = saprfc_table_read ($fce,"ZSFI_COBRANZA5_BSEG",$i);
	$rows = saprfc_table_rows ($fce,"ZSFI_COBRANZA5_BSE_CLR");
	for ($i=1;$i<=$rows;$i++)
		$ZSFI_COBRANZA5_BSE_CLR[] = saprfc_table_read ($fce,"ZSFI_COBRANZA5_BSE_CLR",$i);
	$rows = saprfc_table_rows ($fce,"ZSFI_COBRANZA5_CAB");
	for ($i=1;$i<=$rows;$i++)
		$ZSFI_COBRANZA5_CAB[] = saprfc_table_read ($fce,"ZSFI_COBRANZA5_CAB",$i);
	$rows = saprfc_table_rows ($fce,"ZSFI_COBRANZA5_CHEQUE");
	for ($i=1;$i<=$rows;$i++)
		$ZSFI_COBRANZA5_CHEQUE[] = saprfc_table_read ($fce,"ZSFI_COBRANZA5_CHEQUE",$i);

	cargar_sql_v2($ZSFI_COBRANZA5_BSEG,'cobranza5_bseg_crm_tmp',null,'I',$serv);
	cargar_sql_v2($ZSFI_COBRANZA5_BSE_CLR,'cobranza5_bseclr_crm_tmp',null,'I',$serv);
	cargar_sql_v2($ZSFI_COBRANZA5_CAB,'cobranza5_cab_crm_tmp',null,'I',$serv);
	cargar_sql_v2($ZSFI_COBRANZA5_CHEQUE,'cobranza5_cheque_crm_tmp',null,'I',$serv);
	saprfc_function_free($fce);
	unset($ZSFI_COBRANZA5_BSEG,$ZSFI_COBRANZA5_BSE_CLR,$ZSFI_COBRANZA5_CAB,$ZSFI_COBRANZA5_CHEQUE,$cbz,$fce,$rfc_rc,$sql,$sql_ok);

/************************************************************************************
 *     A CONTINUACION SE TRATAN SQL
 * 
 ************************************************************************************/
	
	$serv->set_subestado("iniciando proceso ZFI_COBRANZA5(SQL)");

		
	
?>
