<?php

	$fce = saprfc_function_discover($rfc,"ZIF_VENTA");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_VENTA"); exit; }

	saprfc_import ($fce,"BUKRS","AR20");
	saprfc_import ($fce,"CLASE","");
	saprfc_import ($fce,"FECHA_DESDE",$fecha_inicio);
	saprfc_import ($fce,"FECHA_HASTA",$fecha_fin);
	saprfc_import ($fce,"RUTA","");
	saprfc_import ($fce,"TIPO","");
	//Fill internal tables
	saprfc_table_init ($fce,"EX_VENTA");
		//Do RFC call of function ZIF_VENTA, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZIF_VENTA");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"EX_VENTA");
	for ($i=1;$i<=$rows;$i++)
		$EX_VENTA[] = saprfc_table_read ($fce,"EX_VENTA",$i);
	//Debug info

		$sql="DELETE FROM venta_crm WHERE date_concurrency <= DATE_SUB(NOW(), INTERVAL 1 HOUR) AND BUKRS='AR20'";
		try { //BORRAMOS TODAS LAS NOVEDADES CON MAS DE UNA HORA
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			$serv->pongo_hayError($sql."||".$e);
			$sql_ok = false;
		}
		
		foreach ($EX_VENTA as $vta) {
		$venta = new Venta_CRM_TODO();
		$venta = $venta->buscarExtendido($vta[VBELN], $vta[ERDAT], $vta[KUNNR], $vta[MATNR], $vta[POSNR]);
		foreach ($vta as $k =>$v){
				$venta->$k = $vta[$k];
			}	
		$venta->save();
		if (!$serv->is_running()){exit;}		
	}

	if (!$serv->is_running()){exit;}		
		
	saprfc_function_free($fce);
	
	unset($fce,$rfc_rc,$rows,$EX_VENTA,$venta,$tarea,$mat,$pend,$RETURN,$T_EXBEREIT,$out,$i_ret,$TIENE_ERRORES,$retu,$res,$tiene_tareas_pendientes);

	
/******************************************************************
 * 
 * 
 * 
 * 
 * 
 * 
 ******************************************************************/	
	
	
	

	$fce = saprfc_function_discover($rfc,"ZIF_VENTA");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_VENTA"); exit; }

	saprfc_import ($fce,"BUKRS","PE10");
	saprfc_import ($fce,"CLASE","");
	saprfc_import ($fce,"FECHA_DESDE",$fecha_inicio);
	saprfc_import ($fce,"FECHA_HASTA",$fecha_fin);
	saprfc_import ($fce,"RUTA","");
	saprfc_import ($fce,"TIPO","");
	//Fill internal tables
	saprfc_table_init ($fce,"EX_VENTA");
		//Do RFC call of function ZIF_VENTA, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZIF_VENTA");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"EX_VENTA");
	for ($i=1;$i<=$rows;$i++)
		$EX_VENTA[] = saprfc_table_read ($fce,"EX_VENTA",$i);
	//Debug info

		$sql="DELETE FROM venta_crm WHERE date_concurrency <= DATE_SUB(NOW(), INTERVAL 1 HOUR) AND BUKRS='PE10'";
		try { //BORRAMOS TODAS LAS NOVEDADES CON MAS DE UNA HORA
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			$serv->pongo_hayError($sql."||".$e);
			$sql_ok = false;
		}
		
		foreach ($EX_VENTA as $vta) {
		$venta = new Venta_CRM_TODO();
		$venta = $venta->buscarExtendido($vta[VBELN], $vta[ERDAT], $vta[KUNNR], $vta[MATNR], $vta[POSNR]);
		foreach ($vta as $k =>$v){
				$venta->$k = $vta[$k];
			}	
		$venta->save();
		if (!$serv->is_running()){exit;}		
	}

	if (!$serv->is_running()){exit;}		
		
	saprfc_function_free($fce);
	
	unset($fce,$rfc_rc,$rows,$EX_VENTA,$venta,$tarea,$mat,$pend,$RETURN,$T_EXBEREIT,$out,$i_ret,$TIENE_ERRORES,$retu,$res,$tiene_tareas_pendientes);
	
	
	
	
	
	
	
	
?>