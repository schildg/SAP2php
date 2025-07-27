<?php
	
/************************************************************************************
 *     A CONTINUACION SE TRATAN LOS MATERIALES
 * 
 ************************************************************************************/
	$lista_materiales = array_unique($lista_materiales);

    $material_ord_fab = array();
	foreach ($lista_materiales  as $mtr){
		$serv->set_subestado("conectando BAPI_MATERIAL_GET_DETAIL");
		$fce = saprfc_function_discover($rfc,"BAPI_MATERIAL_GET_DETAIL");
		if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed   BAPI_MATERIAL_GET_DETAIL"); exit; }
		saprfc_import ($fce,"MATERIAL",$mtr);
		saprfc_import ($fce,"MATERIAL_EVG", array ("MATERIAL_EXT"=>"","MATERIAL_VERS"=>"","MATERIAL_GUID"=>""));
		saprfc_import ($fce,"PLANT","");
		saprfc_import ($fce,"VALUATIONAREA","");
		saprfc_import ($fce,"VALUATIONTYPE","");
							
		$rfc_rc = saprfc_call_and_receive ($fce);
		if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_secue("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError (saprfc_error($fce)); exit; }
		//Retrieve export parameters
		$MATERIALPLANTDATA = saprfc_export ($fce,"MATERIALPLANTDATA");
		$MATERIALVALUATIONDATA = saprfc_export ($fce,"MATERIALVALUATIONDATA");
		$MATERIAL_GENERAL_DATA = saprfc_export ($fce,"MATERIAL_GENERAL_DATA");
		$RETURN = saprfc_export ($fce,"RETURN");
		
		if (!file_exists(PATH_NOVEDADES_SALIDA) || !file_exists(PATH_NOVEDADES_SALIDA_CONTROL)){$serv->pongo_hayError("NO EXISTEN Ó NO ESTAN CONECTADOS ".PATH_NOVEDADES_SALIDA."  ".PATH_NOVEDADES_SALIDA_CONTROL); exit; }	
		$serv->set_subestado("procesando respuesta BAPI_MATERIAL_GET_DETAIL   ".$mtr);
		$material = new Material();	
		$material_anteriror = new Material();
		$material_anteriror = $material_anteriror->buscarExtendido($mtr);
		$tipo_cambio = "SINCAMBIOS";
		if (!$material_anteriror->existe($mtr)){
			foreach ($MATERIAL_GENERAL_DATA as $k => $v) {
				$material->$k = $v;
			}
			$material->MATERIAL = $mtr;
			$material->save();
			$tipo_cambio = "ALTA";
		}else{
			$material = $material_anteriror;
			foreach ($MATERIAL_GENERAL_DATA as $k => $v) {
				$material->$k = $v;
			}
			foreach ($MATERIAL_GENERAL_DATA as $k => $v) {
				if($material->$k!=$material_anteriror->$k){
					$tipo_cambio = "MODIFICACION";
				}
			}		
			$material->save();
		}
		$cab[MATNR]= $mtr;
		$cab[TIPO_CAMBIO]=$tipo_cambio;
		$material_ord_fab = cargo_sin_duplicados($material_ord_fab, $cab);		
	//	$serv->set_subestado("liberando recursos");
		saprfc_function_free($fce);
		
	}
	$material = new Material();
	foreach ($material_ord_fab  as $mtr){
		
		if ($mtr[TIPO_CAMBIO]=="ALTA"){
			$material = $material->buscarExtendido($mtr[MATNR]);
			$serv->paquete="s".str_pad($serv->incrementar_secuencia(),6,"0",STR_PAD_LEFT).".paq";
			$serv->save();
			$file_paquete= fopen(PATH_NOVEDADES_SALIDA.$serv->paquete, "w");
			if($material->MATL_TYPE=="ZGEN"){
				fwrite($file_paquete,"MATERIAL;st-pro;".
				$material->MATERIAL.";".
				$material->MATL_DESC.";".
				$material->OLD_MAT_NO.";".
				$material->BASE_UOM.";".
				";\r\n");
			}else{
				fwrite($file_paquete,"MATERIAL;st-art;".
				$material->MATERIAL.";".
				$material->MATL_DESC.";".
				$material->OLD_MAT_NO.";".
				$material->BASE_UOM.";".
				";\r\n");
			}
			fclose ($file_paquete);			
			$file_paquete= fopen(PATH_NOVEDADES_SALIDA_CONTROL.$serv->paquete.".con", "w");
			fclose ($file_paquete);																
		}
	}
	
?>
