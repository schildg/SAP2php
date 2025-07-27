<?php







	//Discover interface for function module ZRFCPP_ORDFAB
	$fce = saprfc_function_discover($rfc,"ZRFCPP_ORDFAB");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZRFCPP_ORDFAB"); exit; }
	//Fill internal tables
	saprfc_import ($fce,"ORDER_OBJECTS", array ("HEADER"=>"1","POSITIONS"=>"1","SEQUENCES"=>"","OPERATIONS"=>"1","COMPONENTS"=>"1","PROD_REL_TOOLS"=>"","TRIGGER_POINTS"=>"","SUBOPERATIONS"=>""));
	//Fill internal tables
	saprfc_table_init ($fce,"COMPONENT");
	saprfc_table_init ($fce,"HEADER");
	saprfc_table_init ($fce,"OPERATION");
	saprfc_table_init ($fce,"POSITION");
	saprfc_table_init ($fce,"PROD_REL_TOOL");
	saprfc_table_init ($fce,"RETURN");
	saprfc_table_init ($fce,"SEQUENCE");
	saprfc_table_init ($fce,"TRIGGER_POINT");
	saprfc_table_init ($fce,"ZRANGEAUFNR");
	saprfc_table_init ($fce,"ZRANGEDISPO");
	saprfc_table_init ($fce,"ZRANGEFEVOR");
	saprfc_table_init ($fce,"ZRANGEGLTRP");
	saprfc_table_init ($fce,"ZRANGEGLTRS");
	saprfc_table_init ($fce,"ZRANGEGSTRP");
	saprfc_table_init ($fce,"ZRANGEGSTRS");
	saprfc_table_append ($fce,"ZRANGEGSTRS", array ("SIGN"=>"I","OPTION"=>"BT","LOW"=>$fecha_inicio,"HIGH"=>$fecha_fin));
	saprfc_table_init ($fce,"ZRANGELGORT");
	saprfc_table_append ($fce,"ZRANGELGORT", array ("SIGN"=>"I","OPTION"=>"EQ","LOW"=>"PRFE","HIGH"=>""));
	saprfc_table_init ($fce,"ZRANGEPLNBEZ");
	saprfc_table_init ($fce,"ZRANGESTAT");
	saprfc_table_append ($fce,"ZRANGESTAT", array ("SIGN"=>"I","OPTION"=>"BT","LOW"=>"I0002","HIGH"=>"I0002"));
	saprfc_table_init ($fce,"ZRANGEWERKS");
	saprfc_table_append ($fce,"ZRANGEWERKS", array ("SIGN"=>"I","OPTION"=>"EQ","LOW"=>"2004","HIGH"=>""));
	//Do RFC call of function ZRFCPP_ORDFAB, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZRFCPP_ORDFAB");
	//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"COMPONENT");
	for ($i=1;$i<=$rows;$i++)
		$COMPONENT[] = saprfc_table_read ($fce,"COMPONENT",$i);
	$rows = saprfc_table_rows ($fce,"HEADER");
	for ($i=1;$i<=$rows;$i++)
		$HEADER[] = saprfc_table_read ($fce,"HEADER",$i);
	$rows = saprfc_table_rows ($fce,"OPERATION");
	for ($i=1;$i<=$rows;$i++)
		$OPERATION[] = saprfc_table_read ($fce,"OPERATION",$i);
	$rows = saprfc_table_rows ($fce,"POSITION");
	for ($i=1;$i<=$rows;$i++)
		$POSITION[] = saprfc_table_read ($fce,"POSITION",$i);
	$rows = saprfc_table_rows ($fce,"PROD_REL_TOOL");
	for ($i=1;$i<=$rows;$i++)
		$PROD_REL_TOOL[] = saprfc_table_read ($fce,"PROD_REL_TOOL",$i);
	$rows = saprfc_table_rows ($fce,"RETURN");
	for ($i=1;$i<=$rows;$i++)
		$RETURN[] = saprfc_table_read ($fce,"RETURN",$i);
	$rows = saprfc_table_rows ($fce,"SEQUENCE");
	for ($i=1;$i<=$rows;$i++)
		$SEQUENCE[] = saprfc_table_read ($fce,"SEQUENCE",$i);
	$rows = saprfc_table_rows ($fce,"TRIGGER_POINT");
	for ($i=1;$i<=$rows;$i++)
		$TRIGGER_POINT[] = saprfc_table_read ($fce,"TRIGGER_POINT",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGEAUFNR");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGEAUFNR[] = saprfc_table_read ($fce,"ZRANGEAUFNR",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGEDISPO");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGEDISPO[] = saprfc_table_read ($fce,"ZRANGEDISPO",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGEFEVOR");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGEFEVOR[] = saprfc_table_read ($fce,"ZRANGEFEVOR",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGEGLTRP");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGEGLTRP[] = saprfc_table_read ($fce,"ZRANGEGLTRP",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGEGLTRS");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGEGLTRS[] = saprfc_table_read ($fce,"ZRANGEGLTRS",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGEGSTRP");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGEGSTRP[] = saprfc_table_read ($fce,"ZRANGEGSTRP",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGEGSTRS");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGEGSTRS[] = saprfc_table_read ($fce,"ZRANGEGSTRS",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGELGORT");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGELGORT[] = saprfc_table_read ($fce,"ZRANGELGORT",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGEPLNBEZ");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGEPLNBEZ[] = saprfc_table_read ($fce,"ZRANGEPLNBEZ",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGESTAT");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGESTAT[] = saprfc_table_read ($fce,"ZRANGESTAT",$i);
	$rows = saprfc_table_rows ($fce,"ZRANGEWERKS");
	for ($i=1;$i<=$rows;$i++)
		$ZRANGEWERKS[] = saprfc_table_read ($fce,"ZRANGEWERKS",$i);
	
    if (!$serv->is_running()){exit;}		
	
			
	$orden_para_actualizar=array();
	foreach ($HEADER as $hdr) {
		$hd = new OrdenProduccion();	
		$hd = $hd->buscarExtendido($hdr[ORDER_NUMBER]);
		foreach ($hdr as $k =>$v){
				$hd->$k = $hdr[$k];
		}	
		if($hd->ORDER_TYPE=='FRAC'){
			$hd->para_actualizar=1;
			$hd->Enviado_Anita= 'NOVA';
		}
		if($hd->para_actualizar==0){
			$orden_para_actualizar[$hdr[ORDER_NUMBER]]=1;
		}
		$hd->save();
    	if (!$serv->is_running()){exit;}		
	}

	
    $lista_materiales=array();

	foreach ($HEADER as $hdr) {
		if(array_key_exists($hdr[ORDER_NUMBER],$orden_para_actualizar)){
			array_push($lista_materiales, $hdr[MATERIAL]);
			$cabecera_formulas = cargo_sin_duplicados($cabecera_formulas ,array("ORDER_NUMBER"=>$hdr[ORDER_NUMBER],"MATERIAL"=>$hdr[MATERIAL],"PRODUCTION_PLANT"=>$hdr[PRODUCTION_PLANT],"STLAN"=>$hdr[STLAN],"STLAL"=>$hdr[STLAL]));
		}
	}

	foreach ($COMPONENT as $cmt) {
		if(array_key_exists($cmt[ORDER_NUMBER],$orden_para_actualizar)){
			array_push($lista_materiales, $cmt[MATERIAL]);
		}
	}
	
	
	//include("impoMaterial.php"); esta biblioteca se desahabilita para que se informe el error de que falta el material
	//                             en el caso qde querer habilitarla, comentar la siguiente
	include("impoMaterialNN.php");
	include("impoFormulas.php");
	
	foreach ($HEADER as $hdr) {
		if(array_key_exists($hdr[ORDER_NUMBER],$orden_para_actualizar)){
			if($hdr[BATCH]==''){
				$serv->pongo_hayError("la Orden $hdr[ORDER_NUMBER] no tiene asignado un numero de batch");
				exit();
			}
		}
    	if (!$serv->is_running()){exit;}		
	}
	
	if (!$serv->is_running()){exit;}		
	$serv->set_subestado("procesando respuesta ZRFCPP_ORDFAB->OPERATION");

	foreach ($OPERATION as $opr) {
		if(array_key_exists($opr[OPERATION_NUMBER],$orden_para_actualizar)){
			$operation = new Operacion();
			$operation = $operation->buscarExtendido($opr[AUFNR],$opr[OPERATION_NUMBER]);
			foreach ($opr as $k =>$v){
				$operation->$k = $opr[$k];
			}		
			$operation->save();
		}
    	if (!$serv->is_running()){exit;}		
	}
		  

	if (!$serv->is_running()){exit;}		
	$serv->set_subestado("procesando respuesta ZRFCPP_ORDFAB->COMPONENT");
	
	foreach ($COMPONENT as $cmt) {
		if(array_key_exists($cmt[ORDER_NUMBER],$orden_para_actualizar)){
			$component = new Componente();	
			$component = $component->buscarExtendido($cmt[ORDER_NUMBER],$cmt[RESERVATION_ITEM]);
			foreach ($cmt as $k =>$v){
				$component->$k = $cmt[$k];
			}		
			$component->save();
		}
	    if (!$serv->is_running()){exit;}		
	}
	
	if (!$serv->is_running()){exit;}		
	$serv->set_subestado("procesando respuesta ZRFCPP_ORDFAB->POSITION");
	
	foreach ($POSITION as $posi) {
		if(array_key_exists($posi[ORDER_NUMBER],$orden_para_actualizar)){
			$position = new Posicion();	
			$position = $position->buscarExtendido($posi[ORDER_NUMBER],$posi[ORDER_ITEM_NUMBER]);
			foreach ($posi as $k =>$v){
				$position->$k = $posi[$k];
			}		
			$position->save();
		}
    	if (!$serv->is_running()){exit;}		
	}
		
	$serv->set_subestado("liberando recursos");
	saprfc_function_free($fce);
    if (!$serv->is_running()){exit;}		
	
	if (!file_exists(PATH_NOVEDADES_SALIDA)){$serv->pongo_hayError("no existe el directorio".PATH_NOVEDADES_SALIDA);exit;};
	$lista_ord_fab = new OrdenProduccion();
	$lista_ord_fab = $lista_ord_fab->FindAll("OrdenProduccion", "Enviado_Anita = ''");
	foreach ($lista_ord_fab as $hdr){
		$serv->paquete="s".str_pad($serv->incrementar_secuencia(),6,"0",STR_PAD_LEFT).".paq";
		$serv->save();
		$material = new Material();
		$material = $material->buscarExtendido($hdr->MATERIAL);
		$file_paquete= fopen(PATH_NOVEDADES_SALIDA.$serv->paquete, "w");
		fwrite($file_paquete,"ORDFAB;px-pfp;".
		$hdr->ORDER_NUMBER.";".   //numero de  orden de fabricacion   (NMOV-LQ)
		$hdr->MRP_CONTROLLER.";".   //Planificador necesidades para orden   (LINE-LQ)
									//				A40	Planificador P CDU
									//				A41	Línea Limpia
									//				A42	Línea Medicada
									//				A43	Línea Limpia/Medic
									//				A44	Línea Biodiesel
		$hdr->PRODUCTION_SCHEDULER.";".   //Responsable de control de producción	 
									//				E02	GRANEL Premix - Ingredientes
									//				E03	ENVASADO Premix - Ingredientes
									//				E04	ACONDIC. Premix - Ingredientes
									//				E05	GRANEL  Premix - Soluciones
									//				E06	ENVASADO Premix - Soluciones
									//				E07	ACONDIC. Premix - Soluciones
									//				E08	GRANEL Biológicos
									//				E09	ENVASADO Biológicos
									//				E10	ACONDIC. Biológicos
									//				E11	GRANEL  Desinfectantes
									//				E12	ENVASADO Desinfectantes
		$hdr->MATERIAL.";".   			//Número de material		(PROD-LQ) 
		$hdr->PRODUCTION_PLANT.";".     //Centro
		$hdr->SCHED_RELEASE_DATE.";".   //Fecha de liberación programada	(FTUR-LQ)		 
		$hdr->PRODUCTION_START_DATE.";".   		//Fecha de inicio extrema			(FEFI-LQ)		 
		$hdr->SCHED_START_TIME.";".   		//Hora de inicio extrema	(Hora)	(HEFI-LQ)		 
		number_format($hdr->TARGET_QUANTITY, 3, '.', '').";".   		//Cantidad total de la orden	(CORI-LQ)		 
		$hdr->ENTERED_BY.";".   		//Nombre del autor					(AUFA-LQ)		 
		$hdr->BATCH.";".   				//Numero de Lote					(LOTN-LQ)
		$material->MHDHB.";".           // Meses de vigencia de un lote		 
		((int)$hdr->MATERIAL)."_".$hdr->PRODUCTION_PLANT."_".$hdr->STLAN."_".$hdr->STLAL.";".   				//Lista de materiales + Alternativa + Utilizacion				(NFOR-LQ)		 
		"\r\n");
		foreach ($component_ord_fab as $cmt){
			if ($cmt[ORDER_NUMBER]==$hdr->ORDER_NUMBER){
				$material = $material->buscarExtendido($cmt[MATERIAL]);
				if($material->MTART=="ZGEN"){
					fwrite($file_paquete,"ORDFAB;st-pro;".    // Si es un material ZGEN es un generico por  lo tanto es un st-pro, que es parte de la lista de materiales
					$cmt[MATERIAL].";".	                      // Codigo de material         
					$cmt[REQ_QUAN].";".                       // Cantidad
					$cmt[BASE_UOM].";".                       // Unidad Base
					"\r\n");
				}else{
					fwrite($file_paquete,"ORDFAB;st-art;".   // Si NO es un material ZGEN es un insumo, por  lo tanto es un st-art, que es parte de los insumos
					$cmt[MATERIAL].";".	                      // Codigo de material         
					$cmt[REQ_QUAN].";".                       // Cantidad
					$cmt[BASE_UOM].";".                       // Unidad Base
					"\r\n");
				}							
			}
		}  
		fclose ($file_paquete);			
		$file_paquete= fopen(PATH_NOVEDADES_SALIDA_CONTROL.$serv->paquete.".con", "w");
//		echo PATH_NOVEDADES_SALIDA_CONTROL.$serv->paquete.".con"."\r\n";
		fclose ($file_paquete);
		$hdr->para_actualizar=true;									
		$hdr->Enviado_Anita="SI";
		$hdr->save();
	}
	
	$lista_ord_fab = new OrdenProduccion();
	$lista_ord_fab = $lista_ord_fab->FindAll("OrdenProduccion", "para_actualizar = 0");
	foreach ($lista_ord_fab as $hdr){
		$hdr->para_actualizar=1;									
		$hdr->save();
	}
	unset($fce,$rfc_rc,$rows,$COMPONENT,$HEADER,$OPERATION,$POSITION,$PROD_REL_TOOL,$RETURN,$SEQUENCE,$TRIGGER_POINT,$ZRANGEAUFNR,$ZRANGEDISPO,$ZRANGEFEVOR,$ZRANGEGLTRP,$ZRANGEGLTRS,$ZRANGEGSTRP,$ZRANGEGSTRS,$ZRANGELGORT,$ZRANGEPLNBEZ,$ZRANGESTAT,$ZRANGEWERKS,
			$cabecera_formulas,$lista_materiales,$hd,$lista_ord_fab,$material,$file_paquete);
?>