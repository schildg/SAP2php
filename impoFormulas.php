<?php
	
/************************************************************************************
 *     A CONTINUACION SE TRATAN LAS LISTA DE MATERIALES SAP CON NUESTRAS FORMULAS
 *  esta rutina en un futuro se DEBERIA AUTOMATIZAR PARA QUE LAS IMPORTE Y ACTUALIZE DESDE SAP!
 ************************************************************************************/

	foreach ($cabecera_formulas  as $hdr){
		$ns_rel = new Ns_Rel();
		if (!$ns_rel->existe("FORMULA",((int)$hdr[MATERIAL])."_".$hdr[PRODUCTION_PLANT]."_".$hdr[STLAN]."_".$hdr[STLAL])){
			$serv->subestado= "tratando Formulas/Lista de Materiales";
			$cadena="No existe en Anita la relacion con la Formula ";
			foreach ($cabecera_formulas  as $hdr){
				$ns_rel = new Ns_Rel();
				if (!$ns_rel->existe("FORMULA",((int)$hdr[MATERIAL])."_".$hdr[PRODUCTION_PLANT]."_".$hdr[STLAN]."_".$hdr[STLAL])){
					$cadena=$cadena." ".((int)$hdr[MATERIAL])."_".$hdr[PRODUCTION_PLANT]."_".$hdr[STLAN]."_".$hdr[STLAL]." - en la OF  ".$hdr[ORDER_NUMBER]."\r\n";
				}
			}
			$serv->pongo_hayError($cadena);			
			exit();
		}
	}
	
?>
