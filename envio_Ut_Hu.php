<?php
include_once ("Clases/Ut_Hu.php");
$ut_hu = new Ut_Hu();

$aUt_Hus = $ut_hu->FindAll('Ut_Hu','estado = "PEN"');

if (!file_exists(PATH_NOVEDADES_SALIDA)){$serv->pongo_hayError("no existe el directorio".PATH_NOVEDADES_SALIDA);exit;};

foreach ($aUt_Hus as $ut_hu){
	$serv->set_subestado("generando envio de HU SAP a las UTs");
	$serv->paquete="s".str_pad($serv->incrementar_secuencia(),6,"0",STR_PAD_LEFT).".paq";
	$serv->save();
	$file_paquete= fopen(PATH_NOVEDADES_SALIDA.$serv->paquete, "w");
	fwrite($file_paquete,"UT_HU;ns-rel;".$ut_hu->cmov_lu.";".$ut_hu->nmov_lu.";".$ut_hu->EXIDV_OB.";\r\n");
	fclose ($file_paquete);			
	$file_paquete= fopen(PATH_NOVEDADES_SALIDA_CONTROL.$serv->paquete.".con", "w");
	fclose ($file_paquete);	
	$ut_hu->estado="OKs";
	$ut_hu->save();								

}

unset($aUt_Hus,$ut_hu);
?>