<?php
include_once ("Clases/At_Mov.php");
$at_mov = new At_Mov();

$aAt_movs= $at_mov->FindAll('At_Mov','estado = "PEN"');

if (!file_exists(PATH_NOVEDADES_SALIDA)){$serv->pongo_hayError("no existe el directorio".PATH_NOVEDADES_SALIDA);exit;};

foreach ($aAt_movs as $at_mov){
	$serv->set_subestado("generando envio de Movimientos SAP a los  Fabricados");
	$serv->paquete="s".str_pad($serv->incrementar_secuencia(),6,"0",STR_PAD_LEFT).".paq";
	$serv->save();
	$file_paquete= fopen(PATH_NOVEDADES_SALIDA.$serv->paquete, "w");
	fwrite($file_paquete,"AT_MOV;st-doc;".$at_mov->MBLNR.";".$at_mov->MJAHR.";".$at_mov->cmov_sd.";".$at_mov->nmov_sd.";".$at_mov->cmov_lu.";".$at_mov->nmov_lu.";".$at_mov->cant_lt.";\r\n");
	fclose ($file_paquete);			
	$file_paquete= fopen(PATH_NOVEDADES_SALIDA_CONTROL.$serv->paquete.".con", "w");
	fclose ($file_paquete);	
	$at_mov->estado="OKs";
	$at_mov->save();								

}

unset($aAt_movs,$at_mov);
?>