<?php

$sql="DELETE FROM material_crm WHERE date_concurrency <= DATE_SUB(NOW(), INTERVAL 23 HOUR) ";
try { //BORRAMOS TODAS LAS NOVEDADES CON MAS DE UNA HORA
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}


/************************************************************************************
 *     A CONTINUACION SE TRATAN LOS MATERIALES
 * 
 ************************************************************************************/
$fce = saprfc_function_discover($rfc,"ZIF_PRODUCTOS");
if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_PRODUCTOS"); exit; }
saprfc_import ($fce,"BUKRS","AR20");
saprfc_import ($fce,"RUTA","");
saprfc_import ($fce,"TIPO","");
//Fill internal tables
saprfc_table_init ($fce,"EX_PRODUCTOS");
saprfc_table_append ($fce,"EX_PRODUCTOS", array ("MATNR"=>"","LAND1"=>"","MATKL"=>"","PRDHA"=>"","MTART"=>"","MAKTG"=>"","MEINS"=>"","PACKING"=>"","PRO_PEL"=>"","BISMT"=>"","MHDHB"=>""));
//Do RFC call of function ZIF_PRODUCTOS, for handling exceptions use saprfc_exception()
$rfc_rc = saprfc_call_and_receive ($fce);
if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_secue("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError (saprfc_error($fce)); exit; }
//Retrieve export parameters
$rows = saprfc_table_rows ($fce,"EX_PRODUCTOS");
for ($i=1;$i<=$rows;$i++)
	$EX_PRODUCTOS[] = saprfc_table_read ($fce,"EX_PRODUCTOS",$i);
//Debug info
	$serv->set_subestado("procesando respuesta ZIF_PRODUCTOS");
	
foreach ($EX_PRODUCTOS as $mta) {
	if(!empty($mta[MATNR])){
		$mat = new Material();
		$mat = $mat->buscarExtendido($mta[MATNR]);
	//	echo $mta[MATNR]." meins ".$mat->MEINS."\r\n";
		foreach ($mta as $k =>$v){
				$mat->$k = $mta[$k];
			}
		$mat->save();
		if (!$serv->is_running()){exit;}
	}		
}

	
saprfc_function_free($fce);










/************************************************************************************
 *     A CONTINUACION SE TRATAN LOS MATERIALES     PE10
 * 
 ************************************************************************************/
$fce = saprfc_function_discover($rfc,"ZIF_PRODUCTOS");
if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZIF_PRODUCTOS"); exit; }
saprfc_import ($fce,"BUKRS","PE10");
saprfc_import ($fce,"RUTA","");
saprfc_import ($fce,"TIPO","");
//Fill internal tables
saprfc_table_init ($fce,"EX_PRODUCTOS");
saprfc_table_append ($fce,"EX_PRODUCTOS", array ("MATNR"=>"","LAND1"=>"","MATKL"=>"","PRDHA"=>"","MTART"=>"","MAKTG"=>"","MEINS"=>"","PACKING"=>"","PRO_PEL"=>"","BISMT"=>"","MHDHB"=>""));
//Do RFC call of function ZIF_PRODUCTOS, for handling exceptions use saprfc_exception()
$rfc_rc = saprfc_call_and_receive ($fce);
if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_secue("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError (saprfc_error($fce)); exit; }
//Retrieve export parameters
$rows = saprfc_table_rows ($fce,"EX_PRODUCTOS");
for ($i=1;$i<=$rows;$i++)
	$EX_PRODUCTOS[] = saprfc_table_read ($fce,"EX_PRODUCTOS",$i);
//Debug info
	$serv->set_subestado("procesando respuesta ZIF_PRODUCTOS");
	
foreach ($EX_PRODUCTOS as $mta) {
	if(!empty($mta[MATNR])){
		$mat = new Material();
		$mat = $mat->buscarExtendido($mta[MATNR]);
	//	echo $mta[MATNR]." meins ".$mat->MEINS."\r\n";
		foreach ($mta as $k =>$v){
				$mat->$k = $mta[$k];
			}
		$mat->save();
		if (!$serv->is_running()){exit;}
	}		
}

$sql_ok = true; 
$sql = "update material as m left join 
(select matnr,sum(prec) as costo from 
(select (cs.pvprs*s.labst)/t.total as prec,cs.pvprs,s.labst,s.matnr,s.werks,s.lgort,t.total from stock_crm_todo as s 
left join (SELECT sum(labst) as total,matnr FROM `stock_crm_todo` WHERE labst<>0 group by matnr) as t on t.matnr=s.matnr 
left join costo_crm_todo as cs on cs.matnr=s.matnr and cs.bwkey=s.werks 
where t.matnr is not null and s.labst<>0) as f group by matnr) as j on j.matnr=m.matnr 
set m.costo=j.costo where j.costo is not null"; // actualizo el costo de los materilaes
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}

	
saprfc_function_free($fce);










?>
