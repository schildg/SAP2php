<?php
    if (!$serv->is_running()){exit;}
	//Discover interface for function module RFC_READ_TABLE
	$fce = saprfc_function_discover($rfc,"RFC_READ_TABLE");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed RFC_READ_TABLE"); exit; }

	saprfc_import ($fce,"DELIMITER",";");
	saprfc_import ($fce,"NO_DATA","");
	saprfc_import ($fce,"QUERY_TABLE","MARD");
	saprfc_import ($fce,"ROWCOUNT","");
	saprfc_import ($fce,"ROWSKIPS","");
	//Fill internal tables
	saprfc_table_init ($fce,"DATA");
	saprfc_table_init ($fce,"FIELDS");
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MATNR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"WERKS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LGORT","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"PSTAT","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LVORM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LFGJA","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LFMON","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"SPERR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LABST","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"UMLME","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"INSME","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"EINME","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"SPEME","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"RETME","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VMLAB","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VMUML","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VMINS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VMEIN","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VMSPE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VMRET","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KZILL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KZILQ","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KZILE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KZILS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KZVLL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KZVLQ","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KZVLE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KZVLS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"DISKZ","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LSOBS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LMINB","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LBSTF","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"HERKL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"EXPPG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"EXVER","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LGPBE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KLABS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KINSM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KEINM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"KSPEM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"DLINL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"PRCTL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ERSDA","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VKLAB","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VKUML","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LWMKB","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MDRUE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MDJIN","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));

	saprfc_table_init ($fce,"OPTIONS");
	saprfc_table_append ($fce,"OPTIONS", array ("TEXT"=>"WERKS BETWEEN 2001 AND 2005"));
	//Do RFC call of function RFC_READ_TABLE, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta RFC_READ_TABLE -> MARD");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"DATA");
	for ($i=1;$i<=$rows;$i++)
		$DATA[] = saprfc_table_read ($fce,"DATA",$i);
	$rows = saprfc_table_rows ($fce,"FIELDS");
	for ($i=1;$i<=$rows;$i++)
		$FIELDS[] = saprfc_table_read ($fce,"FIELDS",$i);
	$rows = saprfc_table_rows ($fce,"OPTIONS");
	for ($i=1;$i<=$rows;$i++)
		$OPTIONS[] = saprfc_table_read ($fce,"OPTIONS",$i);
	//Debug info
	$clave=array();
//	cargar_sql($FIELDS,$DATA,"existencia_material",$clave,"I",$serv);
	
	foreach ($DATA as $exis) {
		$str= $exis[WA];	
		
		$csv= explode(';',$str);
				
		$obj_ex[MATNR]=$csv[0];
		$obj_ex[WERKS]=$csv[1];
		$obj_ex[LGORT]=$csv[2];
		$obj_ex[PSTAT]=$csv[3];
		$obj_ex[LVORM]=$csv[4];
		$obj_ex[LFGJA]=$csv[5];
		$obj_ex[LFMON]=$csv[6];
		$obj_ex[SPERR]=$csv[7];
		$obj_ex[LABST]=$csv[8];
		$obj_ex[UMLME]=$csv[9];
		$obj_ex[INSME]=$csv[10];
		$obj_ex[EINME]=$csv[11];
		$obj_ex[SPEME]=$csv[12];
		$obj_ex[RETME]=$csv[13];
		$obj_ex[VMLAB]=$csv[14];
		$obj_ex[VMUML]=$csv[15];
		$obj_ex[VMINS]=$csv[16];
		$obj_ex[VMEIN]=$csv[17];
		$obj_ex[VMSPE]=$csv[18];
		$obj_ex[VMRET]=$csv[19];
		$obj_ex[KZILL]=$csv[20];
		$obj_ex[KZILQ]=$csv[21];
		$obj_ex[KZILE]=$csv[22];
		$obj_ex[KZILS]=$csv[23];
		$obj_ex[KZVLL]=$csv[24];
		$obj_ex[KZVLQ]=$csv[25];
		$obj_ex[KZVLE]=$csv[26];
		$obj_ex[KZVLS]=$csv[27];
		$obj_ex[DISKZ]=$csv[28];
		$obj_ex[LSOBS]=$csv[29];
		$obj_ex[LMINB]=$csv[30];
		$obj_ex[LBSTF]=$csv[31];
		$obj_ex[HERKL]=$csv[32];
		$obj_ex[EXPPG]=$csv[33];
		$obj_ex[EXVER]=$csv[34];
		$obj_ex[LGPBE]=$csv[35];
		$obj_ex[KLABS]=$csv[36];
		$obj_ex[KINSM]=$csv[37];
		$obj_ex[KEINM]=$csv[38];
		$obj_ex[KSPEM]=$csv[39];
		$obj_ex[DLINL]=$csv[40];
		$obj_ex[PRCTL]=$csv[41];
		$obj_ex[ERSDA]=$csv[42];
		$obj_ex[VKLAB]=$csv[43];
		$obj_ex[VKUML]=$csv[44];
		$obj_ex[LWMKB]=$csv[45];
		$obj_ex[MDRUE]=$csv[46];
		$obj_ex[MDJIN]=$csv[47];
		
    	$ex_mat = new Existencia_Material();
    	$ex_mat = $ex_mat->buscarExtendido($obj_ex[MATNR],$obj_ex[WERKS],$obj_ex[LGORT]);
    	foreach ($obj_ex as $k=>$v){
    		$ex_mat->$k=$obj_ex[$k];
    	}
    	$ex_mat->C_WERKS=$obj_ex[WERKS];
    	$ex_mat->C_LGORT=$obj_ex[LGORT];
    	$ex_mat->save();
		if (!$serv->is_running()){exit;}		
	}
		
    if (!$serv->is_running()){exit;}		
	
	saprfc_function_free($fce);
	unset($cad,$csv,$str,$obj,$DATA,$FIELDS);
				
	$reg_ult_act = new Actualizacion_CRM("Existencia_Material");
	$reg_ult_act->save();
	
	
	
	
	
/**************************************************************************
 * 
 * CARGO DATOS DE MATERIALES
 * 
 * 
 * 
 */
	include("impo_producto.php");
/*

	//Discover interface for function module RFC_READ_TABLE
	$fce = saprfc_function_discover($rfc,"RFC_READ_TABLE");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed RFC_READ_TABLE"); exit; }

	saprfc_import ($fce,"DELIMITER",";");
	saprfc_import ($fce,"NO_DATA","");
	saprfc_import ($fce,"QUERY_TABLE","MARA");
	saprfc_import ($fce,"ROWCOUNT","");
	saprfc_import ($fce,"ROWSKIPS","");
	//Fill internal tables
	saprfc_table_init ($fce,"DATA");
	saprfc_table_init ($fce,"FIELDS");
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MATNR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ERSDA","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ERNAM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LAEDA","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"AENAM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MTART","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MBRSH","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MATKL","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"BISMT","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MEINS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"FERTH","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"FORMT","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"GROES","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"WRKST","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"NORMT","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LABOR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"BRGEW","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"NTGEW","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"GEWEI","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VOLUM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"VOLEH","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"BEHVO","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"RAUBE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"TEMPB","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"SPART","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"EAN11","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"NUMTP","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"LAENG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"BREIT","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"HOEHE","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MEABM","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"ATTYP","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MFRPN","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MFRNR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MHDHB","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
    if (!$serv->is_running()){exit;}	
	saprfc_table_init ($fce,"OPTIONS");
	//Do RFC call of function RFC_READ_TABLE, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta RFC_READ_TABLE -> MARA");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"DATA");
	for ($i=1;$i<=$rows;$i++)
		$DATA[] = saprfc_table_read ($fce,"DATA",$i);
	$rows = saprfc_table_rows ($fce,"FIELDS");
	for ($i=1;$i<=$rows;$i++)
		$FIELDS[] = saprfc_table_read ($fce,"FIELDS",$i);
	$rows = saprfc_table_rows ($fce,"OPTIONS");
	for ($i=1;$i<=$rows;$i++)
		$OPTIONS[] = saprfc_table_read ($fce,"OPTIONS",$i);
	//Debug info
		
	$clave=array();
	cargar_sql($FIELDS,$DATA,"material",$clave,"I",$serv);
	
    if (!$serv->is_running()){exit;}		
	
	saprfc_function_free($fce);
	unset($cad,$csv,$str,$obj,$DATA,$FIELDS);
				
	*/		

/**************************************************************************
 * 
 * CARGO TEXTO DE MATERIALES
 * 
 * 
 * 
 */

/*
    if (!$serv->is_running()){exit;}
	//Discover interface for function module RFC_READ_TABLE
	$fce = saprfc_function_discover($rfc,"RFC_READ_TABLE");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed RFC_READ_TABLE"); exit; }

	saprfc_import ($fce,"DELIMITER",";");
	saprfc_import ($fce,"NO_DATA","");
	saprfc_import ($fce,"QUERY_TABLE","MAKT");
	saprfc_import ($fce,"ROWCOUNT","");
	saprfc_import ($fce,"ROWSKIPS","");
	//Fill internal tables
	saprfc_table_init ($fce,"DATA");
	saprfc_table_init ($fce,"FIELDS");
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MATNR","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"MAKTG","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	saprfc_table_append ($fce,"FIELDS", array ("FIELDNAME"=>"SPRAS","OFFSET"=>"","LENGTH"=>"","TYPE"=>"","FIELDTEXT"=>""));
	
	saprfc_table_init ($fce,"OPTIONS");
	saprfc_table_append ($fce,"OPTIONS", array ("TEXT"=>"SPRAS EQ `S`"));
	//Do RFC call of function RFC_READ_TABLE, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta RFC_READ_TABLE -> MAKT");
		//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"DATA");
	for ($i=1;$i<=$rows;$i++)
		$DATA[] = saprfc_table_read ($fce,"DATA",$i);
	$rows = saprfc_table_rows ($fce,"FIELDS");
	for ($i=1;$i<=$rows;$i++)
		$FIELDS[] = saprfc_table_read ($fce,"FIELDS",$i);
	$rows = saprfc_table_rows ($fce,"OPTIONS");
	for ($i=1;$i<=$rows;$i++)
		$OPTIONS[] = saprfc_table_read ($fce,"OPTIONS",$i);
	//Debug info
		
    if (!$serv->is_running()){exit;}
	foreach ($DATA as $cad) {
		$str= $cad[WA];	
		
		$csv= explode(';',$str);
		$obj[MATNR]=$csv[0];
		$obj[MAKTG]=$csv[1];
		$obj[SPRAS]=$csv[2];
		
		$cnt = new Material();	

		if ( $cnt->existe($obj[MATNR]) && $obj[SPRAS]=="S"){
*//*			$ob = new Material();	
			$ob = $ob->buscarExtendido($obj[MATNR]);
			$ob->MAKTG=$obj[MAKTG];
			$ob->save();
*//*
			$texto=str_replace("'","",$obj[MAKTG]);
			$sql="INSERT INTO material (MATNR,MAKTG) VALUES ('$obj[MATNR]','$texto') ON DUPLICATE KEY UPDATE MATNR='$obj[MATNR]',MAKTG='$texto'";
			try {
				MyActiveRecord :: Query($sql);
			} catch (Exception $e) {
				$serv->pongo_hayError($sql."||".$e);
				$sql_ok = false;
				echo "ERROR::".$sql."||".$e."\r\n";
				return false;
			}
			
		}
	}
	$reg_ult_act = new Actualizacion_CRM("Material");
	$reg_ult_act->save();
	
	saprfc_function_free($fce);
	unset($cad,$csv,$str,$ob,$obj,$DATA,$FIELDS);
	
	*/
?>