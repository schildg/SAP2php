<?php


$sql_ok = true; 
$sql = "TRUNCATE TABLE `costo_crm_tmp`";       //borro todo los costo de la tabla tremporal
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}


/*********************************************************************************************************
 * 
 *        
 * 
 *********************************************************************************************************/	

	$centro= new Centro();
	$centro =  $centro->FindAll("Centro","BWKEY!=''");
	foreach ($centro as $cnt){
	
		$serv->set_subestado("iniciando proceso ZIF_COSTO_MAT_FECHA($cnt->BWKEY)");
		$fce = saprfc_function_discover($rfc,"ZIF_COSTO_MAT_FECHA");
		if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_COSTO_MAT_FECHA"); exit; }
	
		saprfc_import ($fce,"IBWKEY",$cnt->BWKEY);
		saprfc_import ($fce,"IDATE",$fecha_calc_costo);
		saprfc_import ($fce,"RUTA","");
		saprfc_import ($fce,"TIPO","");
		//Fill internal tables
		saprfc_table_init ($fce,"EX_ZCO_MAT_COST");
		//Do RFC call of function ZIF_COSTO_MAT_FECHA, for handling exceptions use saprfc_exception()
		$rfc_rc = saprfc_call_and_receive ($fce);
		if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
		$serv->set_subestado("procesando respuesta ZIF_COSTO_MAT_FECHA($cnt->BWKEY)");
			//Retrieve export parameters
		$rows = saprfc_table_rows ($fce,"EX_ZCO_MAT_COST");
		for ($i=1;$i<=$rows;$i++)
			$EX_ZCO_MAT_COST[] = saprfc_table_read ($fce,"EX_ZCO_MAT_COST",$i);
			
		foreach ($EX_ZCO_MAT_COST as $csto) {
			$costo = new Costo_CRM_TMP();
			foreach ($csto as $k =>$v){
					$costo->$k = $csto[$k];
				}	
			$costo->save();
			if (!$serv->is_running()){exit;}		
		}
	
		if (!$serv->is_running()){exit;}		
			
		saprfc_function_free($fce);
		
		unset($fce,$rfc_rc,$rows,$EX_ZCO_MAT_COST,$costo,$RETURN,$csto);

	}	
	
	

/***************************************************************************************************
 *                          TODO
 ***************************************************************************************************/

$serv->set_subestado("procesando respuestas ZIF_COSTO_MAT_FECHA(SQL)");

	$sql = "START TRANSACTION";
	try {
		
		MyActiveRecord :: Query($sql);

		$sql = "INSERT IGNORE INTO COSTO_CRM_TODO (BWKEY,MATNR) SELECT BWKEY,MATNR FROM costo_crm_tmp AS P WHERE BWKEY!='' AND MATNR!='' GROUP BY BWKEY,MATNR";       //nuevo costo
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
				
		$sql_ok = true; 
		$sql = "update costo_crm_todo as s left join costo_crm_tmp as t on t.matnr=s.matnr and t.bwkey=s.bwkey  set s.bwtar=t.bwtar,s.fecha=t.fecha,s.lbkum=t.lbkum,s.salk3=t.salk3,s.vprsv=t.vprsv,s.verpr=t.verpr,s.stprs=t.stprs,s.peinh=t.peinh,s.bklas=t.bklas,s.salkv=t.salkv,s.kalnr=t.kalnr,s.bdatj=t.bdatj,s.poper=t.poper,s.untper=t.untper,s.curtp=t.curtp,s.peinh1=t.peinh1,s.vprsv1=t.vprsv1,s.pvprs=t.pvprs,s.waers=t.waers,s.salk31=t.salk31,s.salkv1=t.salkv1 where t.matnr is not null and concat(t.bdatj,t.poper)>=concat(s.bdatj,s.poper)";
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
	

$reg_ult_act = new Actualizacion_CRM("Costo_CRM");
$reg_ult_act->save();


	
	
	
?>