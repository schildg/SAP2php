<?php




	//RFC Call for ZRFCPP_ADDCOMP_ORDFAB
	//Discover interface for function module ZRFCPP_ADDCOMP_ORDFAB
	$fce = saprfc_function_discover($rfc,"ZRFCPP_ADDCOMP_ORDFAB");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   ZRFCPP_ADDCOMP_ORDFAB"  ); exit; }
	//Set import parameters. You can use function saprfc_optional() to mark parameter as optional.
	unset($RETURN,$T_EXBEREIT);
	saprfc_import ($fce,"I_AUFNR",$numero_OF);
	saprfc_import ($fce,"I_COMMIT","X");
	saprfc_import ($fce,"I_ASSIGN","X");
	saprfc_import ($fce,"I_NO_QUAN_CHECK","X");
	saprfc_import ($fce,"I_BLDAT",$str_fecha);
	saprfc_import ($fce,"I_BUDAT",$str_fecha);
	saprfc_import ($fce,"I_VELIN","1");
	
	
	//echo $tarea->cmov_lt.$tarea->nmov_lt."-".$tarea->utor_lt."   HU:".$tarea->nroUtSap()."\r\n";
	
	
	//Fill internal tables
	saprfc_table_init ($fce,"RETURN");
	saprfc_table_init ($fce,"T_EXBEREIT");
	saprfc_table_append ($fce,"T_EXBEREIT", 
		array ("AUFNR"=>$numero_OF,
		       "RSPOS"=>str_pad((int) $OF->posicionMaterial($tarea->nroMaterialSap()),4,"0",STR_PAD_LEFT),
		       "MATNR"=>$tarea->nroMaterialSap(),
		       "WERKS"=>$Op->PLAN_PLANT,
		       "CHARG"=>$tarea->nroLoteSap(),
		       "LGORT"=>$Op->STORAGE_LOCATION,
		       "SOBKZ"=>"",
		       "VORNR"=>"0010",
		       "MENGE"=>$tarea->cant_lt,
		       "MEINS"=>$mat->MEINS,
		       "ERFMG"=>$tarea->cant_lt,
		       "ERFME"=>$mat->MEINS,
		       "VHILM"=>"P.STD",
		       "EXBNR"=>"",
		       "EXIDV"=>"", //$tarea->nroUtSap(),
		       "EXIDV_OB"=>$tarea->nroUtSap(),
		       "EXPLZ"=>"",
		       "ERNAM"=>"",
		       "ERDAT"=>"",
		       "ERZET"=>"",
		       "TWFLG"=>"X",
		       "BERTS"=>""));
		       

	//Do RFC call of function ZRFCPP_ADDCOMP_ORDFAB, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"RETURN");
	for ($i=1;$i<=$rows;$i++)
		$RETURN[] = saprfc_table_read ($fce,"RETURN",$i);
	$rows = saprfc_table_rows ($fce,"T_EXBEREIT");
	for ($i=1;$i<=$rows;$i++)
		$T_EXBEREIT[] = saprfc_table_read ($fce,"T_EXBEREIT",$i);
	//Debug info
        $serv->set_subestado("procesando consumos en ZRFCPP_ADDCOMP_ORDFAB");
		
	foreach ($T_EXBEREIT as $exp) {
		$out = New Out_OrdFab_Consumo();
		$out = $out->buscarExtendido($tarea->nmov_lt);
		foreach ($exp as $k => $v){
			$out->$k = $v;
			echo $k." => ".$v."\r\n";
		};
		$nro_reserva=$out->RSPOS;
		$out->objeto_sap=$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt;
		$out->tarea=$tarea->nmov_lt;
		$out->save();
	}
//	echo "numero de reserva ".$nro_reserva." en la tarea ".$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt."\r\n";
	$i_ret=0;

	$TIENE_ERRORES_86_PARA_TRATAR = false;						   		
	foreach($RETURN as $retu){
		if(!($retu[TYPE]=="" && $retu[NUMBER]==0)){
			$i_ret=$i_ret+1;
			$res = new Resultado_Ejecucion();
			$res = $res->buscarExtendido("ZRFCPP_ADDCOMP_ORDFAB",$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt."-".$i_ret);	
			$res->RFC="ZRFCPP_ADDCOMP_ORDFAB";
			$res->id_objeto_sap=$numero_OF."-".$tarea->cmov_lt.$tarea->nmov_lt."-".$i_ret;			
			$res->tarea = $tarea->nmov_lt;
			foreach ($retu as $k => $v){
				if ($k=="ID"){
				   $res->ID_SAP = $v;
				}else{
					$res->$k = $v;
				}
			};
		   	if(($res->TYPE=="E" && $res->NUMBER == 86)){
			   	$TIENE_ERRORES_86_PARA_TRATAR = true;						   		
		   	}
			$res->save();
		}
	}

	$tarx=$tarea;
	if($TIENE_ERRORES_86_PARA_TRATAR){ //trato los errores de los lotes que le faltan el punto en el nro de despacho
		include ("OBJCL_CHANGE.php");
	}	
	
?>