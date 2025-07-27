<?php
    
/*	$timestamp = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) - ( 5 * 60 * 60 * 24); //Menos 15 DIAS
	$fecha_inicio_DEU = date("Ymd",$timestamp);
	$timestamp1 = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) + ( 3 * 60 * 60 * 24); //MAS 3 DIAS
	$fecha_fin_DEU    =  date("Ymd",$timestamp1);
*/
	//Discover interface for function module ZRFCFI_TRASABCOB2
	$fce = saprfc_function_discover($rfc,"ZRFCFI_TRASABCOB2");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   ZRFCFI_TRASABCOB2"  ); exit; }
	saprfc_table_init ($fce,"ZRANGEAUGDT");
	saprfc_table_append ($fce,"ZRANGEAUGDT", array ("SIGN"=>"I","OPTION"=>"BT","LOW"=>$fecha_inicio,"HIGH"=>$fecha_fin));
	saprfc_table_init ($fce,"ZTTRASABCOB");
	//Do RFC call of function ZRFCFI_TRASABCOB2, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"ZRANGEAUGDT");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGEAUGDT[] = saprfc_table_read ($fce,"ZRANGEAUGDT",$i);
	$rows = saprfc_table_rows ($fce,"ZTTRASABCOB");
	for ($i=1;$i<=$rows;$i++)
		$ZTTRASABCOB[] = saprfc_table_read ($fce,"ZTTRASABCOB",$i);
		//Debug info

	foreach ($ZTTRASABCOB as $cob) {
		$est = New Estruc_TrasabCob();
		$est = $est->buscarExtendido($cob[ZNREC],$cob[ZFACT],$cob[ZSOCI],$cob[ZEJCO]);
		foreach ($cob as $k => $v){
			$est->$k = $v;
		};
		$est->save();
		if (!$serv->is_running()){exit;}		
		
	}					
		
	
	saprfc_function_free($fce);
	
	$reg_ult_act = new Actualizacion_CRM("Estruc_TrasabCob");
	$reg_ult_act->save();
	
	