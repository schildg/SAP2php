<?php
	$sql_ok = true; 
	$sql = "TRUNCATE TABLE `venta_crm_tmp`";       //borro toda la venta
	try {
		MyActiveRecord :: Query($sql);
	} catch (Exception $e) {
		$sql_ok = false;
	}
/***************************************************************************************************
 *                          AR20
 ***************************************************************************************************/
if($fecha_inicio>='20141201'){		
	$serv->set_subestado("iniciando proceso ZIF_VENTA2(AR20)");
	$fce = saprfc_function_discover($rfc,"ZIF_VENTA2");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_VENTA2"); exit; }

	saprfc_import ($fce,"BUKRS","AR20");
	saprfc_import ($fce,"CLASE","");
	saprfc_import ($fce,"FECHA_DESDE",$fecha_inicio);
	saprfc_import ($fce,"FECHA_HASTA",$fecha_fin);
	saprfc_import ($fce,"RUTA","");
	saprfc_import ($fce,"TIPO","");
	//Fill internal tables
	saprfc_table_init ($fce,"EX_VENTA");
		//Do RFC call of function ZIF_VENTA2, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZIF_VENTA2(AR20)");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"EX_VENTA");
	for ($i=1;$i<=$rows;$i++)
		$EX_VENTA[] = saprfc_table_read ($fce,"EX_VENTA",$i);
	//Debug info

	

	foreach ($EX_VENTA as $tmp) {
		$vta = new Venta_CRM_TMP();
		foreach ($tmp as $k =>$v){
				$vta->$k = $tmp[$k];
			}	
		$vta->save();
		if (!$serv->is_running()){exit;}		
	}

	saprfc_function_free($fce);
	unset($fce,$rfc_rc,$rows,$EX_VENTA,$tmp);
}
	
/***************************************************************************************************
 *                          PE10
 ***************************************************************************************************/
if($fecha_inicio>='20131001'){		

	$serv->set_subestado("iniciando proceso ZIF_VENTA2(PE10)");
	$fce = saprfc_function_discover($rfc,"ZIF_VENTA2");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_VENTA2"); exit; }

	saprfc_import ($fce,"BUKRS","PE10");
	saprfc_import ($fce,"CLASE","");
	saprfc_import ($fce,"FECHA_DESDE",$fecha_inicio);
	saprfc_import ($fce,"FECHA_HASTA",$fecha_fin);
	saprfc_import ($fce,"RUTA","");
	saprfc_import ($fce,"TIPO","");
	//Fill internal tables
	saprfc_table_init ($fce,"EX_VENTA");
		//Do RFC call of function ZIF_VENTA2, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZIF_VENTA2(PE10)");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"EX_VENTA");
	for ($i=1;$i<=$rows;$i++)
		$EX_VENTA[] = saprfc_table_read ($fce,"EX_VENTA",$i);
	//Debug info

	

	foreach ($EX_VENTA as $tmp) {
		$vta = new Venta_CRM_TMP();
		foreach ($tmp as $k =>$v){
				$vta->$k = $tmp[$k];
			}	
		$vta->save();
		if (!$serv->is_running()){exit;}		
	}

	saprfc_function_free($fce);
	unset($fce,$rfc_rc,$rows,$EX_VENTA,$tmp);
}	
/***************************************************************************************************
 *                          TODO
 ***************************************************************************************************/

	$serv->set_subestado("iniciando proceso ZIF_VENTA2(SQL)");

	$sql = "START TRANSACTION";
	try {
		MyActiveRecord :: Query($sql);
			
		$sql="insert into venta_crm_todo (
		CRM_ID,KUNNR,MATNR,KUNN2,VKORG,UNNEG,WAERK,ZTERM,BSARK,AUART,WERKS,LGORT,PRCTR,VKGRP,VKBUR,XBLNR,VBELN,POSNR,ERDAT,PU_ML,PU_USD,NETPR,NETPR_USD,CU_ML,CU_USD,WAVWR,WAVWR_USD,ZMENG,ZIEME,STCUR,BSTNK,MEINS,VRKME,HB_EXPDATE,BUKRS,FKART,KKBER,DOCFI,GJAHR,BLART,SHKZG,ZFBDT,PERIO,TIPO,KSTAR,ACTIVO,COSTO_VTA_ACTUAL_USD,COSTO_VTA_ACTUAL_LOC,COSTO_TOTAL_VTA_ACTUAL_USD,COSTO_TOTAL_VTA_ACTUAL_LOC,RENTA_VTA_ACTUAL_USD,RENTA_VTA_ACTUAL_LOC
								) 
		SELECT T.CRM_ID, T.KUNNR, T.MATNR, T.KUNN2, T.VKORG, T.UNNEG, T.WAERK, T.ZTERM, T.BSARK, T.AUART, T.WERKS, T.LGORT, T.PRCTR, T.VKGRP, T.VKBUR, T.XBLNR, concat( T.VBELN, '_', T.PERIO ) AS VBELN, T.POSNR, T.ZFBDT AS ERDAT,  IF(T.PU_ML=0,SUM( T.NETPR )/SUM( T.ZMENG ),T.PU_ML) as PU_ML,  IF(T.PU_USD=0,SUM( T.NETPR_USD )/SUM( T.ZMENG ),T.PU_USD) as PU_USD, SUM( T.NETPR ) AS NETPR, SUM( T.NETPR_USD ) AS NETPR_USD, T.CU_ML, T.CU_USD, SUM( T.WAVWR ) AS WAVWR, SUM( T.WAVWR_USD ) AS WAVWR_USD, SUM( T.ZMENG ) AS ZMENG, T.ZIEME, T.STCUR, T.BSTNK, T.MEINS, T.VRKME,
			   T.HB_EXPDATE, T.BUKRS, T.FKART, T.KKBER, T.DOCFI, T.GJAHR, T.BLART, T.SHKZG, T.ERDAT AS ZFBDT, T.PERIO,T.TIPO,T.KSTAR,'SI' as ACTIVO,
			   cs.pvprs as COSTO_VTA_ACTUAL_USD, cs.pvprs*t.STCUR as COSTO_VTA_ACTUAL_LOC, (SUM( T.ZMENG)*cs.pvprs) as COSTO_TOTAL_VTA_ACTUAL_USD,cs.pvprs*t.STCUR*SUM( T.ZMENG ) as COSTO_TOTAL_VTA_ACTUAL_LOC, (SUM( T.NETPR_USD )-(SUM( T.ZMENG)*cs.pvprs)) as RENTA_VTA_ACTUAL_USD,(SUM( T.NETPR)-(cs.pvprs*t.STCUR*SUM( T.ZMENG ))) as RENTA_VTA_ACTUAL_LOC

   FROM VENTA_CRM_TMP AS t
	LEFT JOIN VENTA_CRM_TODO AS v ON t.BUKRS = v.BUKRS
	AND v.VBELN = concat( T.VBELN, '_', T.PERIO )
	AND t.PERIO = v.PERIO
	AND t.KUNNR = v.KUNNR
	AND t.MATNR = v.MATNR
	LEFT JOIN COSTO_CRM_TODO as CS on t.MATNR=cs.MATNR AND 
	                                  t.WERKS=cs.BWKEY
	WHERE V.ID IS NULL AND ((T.BUKRS='AR20' AND (T.KSTAR LIKE '691111%' OR 
											   T.KSTAR LIKE '692111%' OR 
	   										   T.KSTAR LIKE '694311%' OR 
	   										   T.KSTAR LIKE '701111%' OR
	   										   T.KSTAR LIKE '691112%' OR
	   										   T.KSTAR LIKE '702111%' )) OR
	   						(T.BUKRS='PE10' AND (T.KSTAR LIKE '69%' OR
	   						                   T.KSTAR LIKE '73%' OR
	   						                   T.KSTAR LIKE '70%' OR
	   						                   T.KSTAR LIKE '74%' )))
	GROUP BY T.BUKRS, T.VBELN, T.PERIO, T.KUNNR, T.MATNR";
	
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
				
		$sql="update venta_crm_todo as v left join (
		SELECT T.CRM_ID, T.KUNNR, T.MATNR, T.KUNN2, T.VKORG, T.UNNEG, T.WAERK, T.ZTERM, T.BSARK, T.AUART, T.WERKS, T.LGORT, T.PRCTR, T.VKGRP, T.VKBUR, T.XBLNR, concat( T.VBELN, '_', T.PERIO ) AS VBELN, T.POSNR, T.ZFBDT AS ERDAT, IF(T.PU_ML=0,SUM( T.NETPR )/SUM( T.ZMENG ),T.PU_ML) as PU_ML, IF(T.PU_USD=0,SUM( T.NETPR_USD )/SUM( T.ZMENG ),T.PU_ML) as PU_USD, SUM( T.NETPR ) AS NETPR, SUM( T.NETPR_USD ) AS NETPR_USD, T.CU_ML, T.CU_USD, SUM( T.WAVWR ) AS WAVWR, SUM( T.WAVWR_USD ) AS WAVWR_USD, SUM( T.ZMENG ) AS ZMENG, T.ZIEME, T.STCUR, T.BSTNK, T.MEINS, T.VRKME, T.HB_EXPDATE, T.BUKRS, T.FKART, T.KKBER, T.DOCFI, T.GJAHR, T.BLART, T.SHKZG, T.ERDAT AS ZFBDT, T.PERIO,T.TIPO,T.KSTAR, 'SI' as ACTIVO
	FROM VENTA_CRM_TMP AS t WHERE (T.BUKRS='AR20' AND (T.KSTAR LIKE '691111%' OR
											   T.KSTAR LIKE '691112%' OR 
											   T.KSTAR LIKE '692111%' OR 
	   										   T.KSTAR LIKE '694311%' OR 
	   										   T.KSTAR LIKE '701111%' OR 
	   										   T.KSTAR LIKE '702111%' )) OR
	   						(T.BUKRS='PE10' AND (T.KSTAR LIKE '69%' OR
	   						                   T.KSTAR LIKE '73%' OR
	   						                   T.KSTAR LIKE '70%' OR
	   						                   T.KSTAR LIKE '74%' ))
	GROUP BY T.BUKRS, T.VBELN, T.PERIO, T.KUNNR, T.MATNR ) as s on v.BUKRS=s.BUKRS AND v.VBELN=s.VBELN AND v.PERIO=s.PERIO AND v.KUNNR=s.KUNNR AND v.MATNR=s.MATNR
	SET v.CRM_ID=s.CRM_ID,
	v.KUNNR=s.KUNNR,
	v.MATNR=s.MATNR,
	v.KUNN2=s.KUNN2,
	v.VKORG=s.VKORG,
	v.UNNEG=s.UNNEG,
	v.WAERK=s.WAERK,
	v.ZTERM=s.ZTERM,
	v.BSARK=s.BSARK,
	v.AUART=s.AUART,
	v.WERKS=s.WERKS,
	v.LGORT=s.LGORT,
	v.PRCTR=s.PRCTR,
	v.VKGRP=s.VKGRP,
	v.VKBUR=s.VKBUR,
	v.XBLNR=s.XBLNR,
	v.VBELN=s.VBELN,
	v.POSNR=s.POSNR,
	v.ERDAT=s.ERDAT,
	v.PU_ML=s.PU_ML,
	v.PU_USD=s.PU_USD,
	v.NETPR=s.NETPR,
	v.NETPR_USD=s.NETPR_USD,
	v.CU_ML=s.CU_ML,
	v.CU_USD=s.CU_USD,
	v.WAVWR=s.WAVWR,
	v.WAVWR_USD=s.WAVWR_USD,
	v.ZMENG=s.ZMENG,
	v.ZIEME=s.ZIEME,
	v.STCUR=s.STCUR,
	v.BSTNK=s.BSTNK,
	v.MEINS=s.MEINS,
	v.VRKME=s.VRKME,
	v.HB_EXPDATE=s.HB_EXPDATE,
	v.BUKRS=s.BUKRS,
	v.FKART=s.FKART,
	v.KKBER=s.KKBER,
	v.DOCFI=s.DOCFI,
	v.GJAHR=s.GJAHR,
	v.BLART=s.BLART,
	v.SHKZG=s.SHKZG,
	v.ZFBDT=s.ZFBDT,
	v.PERIO=s.PERIO,
	v.TIPO=s.TIPO,
	v.KSTAR=s.KSTAR,
	v.ACTIVO=s.ACTIVO
	WHERE s.crm_id is not null AND ((S.BUKRS='AR20' AND (S.KSTAR LIKE '691111%' OR 
											   S.KSTAR LIKE '692111%' OR
											   S.KSTAR LIKE '691112%' OR 
	   										   S.KSTAR LIKE '694311%' OR 
	   										   S.KSTAR LIKE '701111%' OR 
	   										   S.KSTAR LIKE '702111%' )) OR
	   						(S.BUKRS='PE10' AND (S.KSTAR LIKE '69%' OR
	   						                   S.KSTAR LIKE '73%' OR
	   						                   S.KSTAR LIKE '70%' OR
	   						                   S.KSTAR LIKE '74%' )))";
	
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
				
		
	
		
		$sql="update venta_crm_todo as v left join (
		SELECT T.KUNNR, T.MATNR, T.KUNN2,concat( T.VBELN, '_', T.PERIO ) AS VBELN, T.BUKRS, T.PERIO, T.KSTAR
	FROM VENTA_CRM_TMP AS t WHERE (T.BUKRS='AR20' AND (T.KSTAR LIKE '691111%' OR
											   T.KSTAR LIKE '691112%' OR 
											   T.KSTAR LIKE '692111%' OR 
	   										   T.KSTAR LIKE '694311%' OR 
	   										   T.KSTAR LIKE '701111%' OR 
	   										   T.KSTAR LIKE '702111%' )) OR
	   						(T.BUKRS='PE10' AND (T.KSTAR LIKE '69%' OR
	   						                   T.KSTAR LIKE '73%' OR
	   						                   T.KSTAR LIKE '70%' OR
	   						                   T.KSTAR LIKE '74%' ))
	GROUP BY T.BUKRS, T.VBELN, T.PERIO, T.KUNNR, T.MATNR ) as s on v.BUKRS=s.BUKRS AND v.VBELN=s.VBELN AND v.PERIO=s.PERIO AND v.KUNNR=s.KUNNR AND v.MATNR=s.MATNR
	SET v.ACTIVO='NO'
	WHERE s.matnr is  null AND ((S.BUKRS='AR20' AND (S.KSTAR LIKE '691111%' OR 
											   S.KSTAR LIKE '692111%' OR
											   S.KSTAR LIKE '691112%' OR 
	   										   S.KSTAR LIKE '694311%' OR 
	   										   S.KSTAR LIKE '701111%' OR 
	   										   S.KSTAR LIKE '702111%' )) OR
	   						(S.BUKRS='PE10' AND (S.KSTAR LIKE '69%' OR
	   						                   S.KSTAR LIKE '73%' OR
	   						                   S.KSTAR LIKE '70%' OR
	   						                   S.KSTAR LIKE '74%' ))) AND v.perio=".substr($fecha_fin, 0, -2);;
	
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