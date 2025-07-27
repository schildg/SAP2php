<?php
	
/************************************************************************************
 *     A CONTINUACION SE TRATAN LOS MATERIALES
 *  esta rutina en un futuro se borrara!
 ************************************************************************************/
	$lista_materiales = array_unique($lista_materiales);

    $material_ord_fab = array();
	foreach ($lista_materiales  as $mtr){
		$ns_rel = new Ns_Rel();
		$mate = new Material();
		$mate = $mate->buscarExtendido($mtr);
		if (!$ns_rel->existe("MATERIAL",$mtr) && !$mate->no_controlar){
			$serv->subestado= "tratando materiales";
			$cadena="No existe en Anita la relacion con el Material ";
			foreach ($lista_materiales  as $mtr){
				$ns_rel = new Ns_Rel();
				if (!$ns_rel->existe("MATERIAL",$mtr)){
					$cadena=$cadena." ".$mtr."- \r\n";
				}
			}
			$serv->pongo_hayError($cadena);
			exit();
	/*	}else{
			$material = new Material();
			if (!$material->existe($mtr)){
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
				
				$serv->set_subestado("procesando respuesta BAPI_MATERIAL_GET_DETAIL   ".$mtr);

				foreach ($MATERIAL_GENERAL_DATA as $k => $v) {
					$material->$k = $v;
				}
				$material->MATERIAL = $mtr;
				$material->save();
				saprfc_function_free($fce);
			}*/
		}
	}
	unset($lista_materiales);
?>
