<?php


$pendiente = new Pendiente_Tratar();
$lista_pendientes = $pendiente->todosCONoTAM("Px_Pfp");
if ($lista_pendientes){
	$serv->set_subestado("iniciando proceso de RSAQ_REMOTE_QUERY_CALL");
	foreach ($lista_pendientes as $pend){
		if ($serv->is_running()){
			$px_pfp = New Px_Pfp();		
			$px_pfp = $px_pfp->buscar($pend->id_objeto);
			if ($px_pfp->cmov_lq=="PF" && $px_pfp->esta_lq==500 && $px_pfp->auno_lq!="" AND $pend->control_movimientos==false){
				$ns_rel = New Ns_Rel();
				$numero_OF = $ns_rel->buscoPF($px_pfp->cmov_lq, $px_pfp->nmov_lq);
				$fce = saprfc_function_discover($rfc,"RSAQ_REMOTE_QUERY_CALL");
				if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   RSAQ_REMOTE_QUERY_CALL"  ); exit; }
				$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL");
				
				saprfc_import ($fce,"DATA_TO_MEMORY","X");
				saprfc_import ($fce,"DBACC","0");
				saprfc_import ($fce,"EXTERNAL_PRESENTATION","");
				saprfc_import ($fce,"QUERY","QUE_RFC_HUMAT2");
				saprfc_import ($fce,"SKIP_SELSCREEN","X");
				saprfc_import ($fce,"USERGROUP","RFC_USERS");
				saprfc_import ($fce,"VARIANT","");
				saprfc_import ($fce,"WORKSPACE","");
				//Fill internal tables
				saprfc_table_init ($fce,"FPAIRS");
				saprfc_table_init ($fce,"LDATA");
				saprfc_table_init ($fce,"LISTDESC");
				saprfc_table_init ($fce,"SELECTION_TABLE");
				saprfc_table_append ($fce,"SELECTION_TABLE", array ("SELNAME"=>"SP$00001","KIND"=>"S","SIGN"=>"I","OPTION"=>"EQ","LOW"=>$numero_OF,"HIGH"=>""));
				
				//Do RFC call of function RSAQ_REMOTE_QUERY_CALL, for handling exceptions use saprfc_exception()
				$rfc_rc = saprfc_call_and_receive ($fce);
				if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
				//Retrieve export parameters
				$serv->set_subestado("procesando RSAQ_REMOTE_QUERY_CALL>> ".$numero_OF);
				
				$LISTTEXT = saprfc_export ($fce,"LISTTEXT");
				$LIST_ID = saprfc_export ($fce,"LIST_ID");
				$PROGRAM = saprfc_export ($fce,"PROGRAM");
				$USED_VARIANT = saprfc_export ($fce,"USED_VARIANT");
				$rows = saprfc_table_rows ($fce,"FPAIRS");
				for ($i=1;$i<=$rows;$i++)
					$FPAIRS[] = saprfc_table_read ($fce,"FPAIRS",$i);
				$rows = saprfc_table_rows ($fce,"LDATA");
				for ($i=1;$i<=$rows;$i++)
					$LDATA[] = saprfc_table_read ($fce,"LDATA",$i);
				$rows = saprfc_table_rows ($fce,"LISTDESC");
				for ($i=1;$i<=$rows;$i++)
					$LISTDESC[] = saprfc_table_read ($fce,"LISTDESC",$i);
				$rows = saprfc_table_rows ($fce,"SELECTION_TABLE");
				for ($i=1;$i<=$rows;$i++)
					$SELECTION_TABLE[] = saprfc_table_read ($fce,"SELECTION_TABLE",$i);
				//Debug info
				//saprfc_function_debug_info($fce);
				
				$tabla=cargo_desde_rfc($LDATA, $LISTDESC);
				if (!$serv->is_running()){exit;}		
				
				foreach ($tabla as $value) {
					$out_gm = New Out_GoodsMvment();
					$out_gm = $out_gm->buscarExtendido($value[BWART], $value[MJAHR], $value[MBLNR]);
					foreach ($value as $k=>$v) {
						$out_gm->$k=$v;
					}
					$out_gm->save();
				    if (!$serv->is_running()){exit;}		
				}
				saprfc_function_free($fce);
				$serv->set_subestado("finalizo RSAQ_REMOTE_QUERY_CALL>> ".$numero_OF);
				$sql="SELECT DISTINCT(IF(CONSUMO_MENGE=MOVIMIENTOS_MENGE,'OK','error')) FROM (SELECT `AUFNR`,CONCAT('000000000',`MATNR`) AS MATNR,SUM(`MENGE`) AS CONSUMO_MENGE FROM out_ordfab_consumo WHERE `AUFNR`='".$numero_OF."' GROUP BY `AUFNR`,`MATNR`) AS C LEFT JOIN (SELECT `AUFNR`,`MATNR`,SUM(`MENGE`) AS `MOVIMIENTOS_MENGE` FROM `out_goodsmvment` WHERE (`BWART`='261' OR `BWART`='262') AND `AUFNR`='".$numero_OF."' GROUP BY `AUFNR`,`MATNR`) AS M
                      ON M.AUFNR=C.AUFNR AND M.MATNR=C.MATNR";
				try {
					$result = MyActiveRecord :: Query($sql);
					while ($estado1[] = mysql_fetch_array($result, MYSQL_ASSOC)){}
				} catch (Exception $e) {
					$sql_ok = false;
				}
				$tiene_error_consumo=false;
				foreach ($estado1 as $est) {
					foreach ($est as $k=>$v) {
						if($v=="error"){
							$tiene_error_consumo=true;
						}
					}
				}
				echo "\r\n";
				$sql="SELECT DISTINCT(IF(INGRESO_MENGE=MOVIMIENTOS_MENGE,'OK','error')) FROM (SELECT `AUFNR`,SUM(QUANTITY) AS INGRESO_MENGE FROM out_emhu_ordfab WHERE `AUFNR`='".$numero_OF."' GROUP BY `AUFNR`) AS I LEFT JOIN (SELECT `AUFNR`,SUM(`MENGE`) AS `MOVIMIENTOS_MENGE` FROM `out_goodsmvment` WHERE (`BWART`='101' OR `BWART`='102') AND `AUFNR`='".$numero_OF."' GROUP BY `AUFNR`) AS M
                      ON M.AUFNR=I.AUFNR";
				try {
					$result = MyActiveRecord :: Query($sql);
					while ($estado2[] = mysql_fetch_array($result, MYSQL_ASSOC)){}
				} catch (Exception $e) {
					$sql_ok = false;
				}
				echo "\r\n";
				$tiene_error_ingreso=false;
				foreach ($estado2 as $est) {
					foreach ($est as $k=>$v) {
						if($v=="error"){
							$tiene_error_ingreso=true;
						}
					}
				}
				if (!($tiene_error_consumo || $tiene_error_ingreso)){
					if($pend->estado=="CON"){
						$pend->control_movimientos=true;
						$pend->estado="CIE";
					}else{
						$pend->estado="Tok";
					}
					$pend->save();
				}else{
					if($pend->estado=="CON"){
						$pend->estado="COx";
					}else{
						$pend->estado="Ter";
					}
					$pend->save();
				}
				
				unset($tabla,$value,$out_gm,$LDATA, $LISTDESC,$FPAIRS,$SELECTION_TABLE,$result,$estado1,$estado2);
			}else{
				if ($pend->control_movimientos){
					$pend->estado="CIE";
					$pend->save();
				}
			}
			if (!$serv->is_running()){exit;}		
			
		}
	}
}


?>