<?php
include_once ("Clases/Servicio.php");
$servicio = new Servicio();

$OBJETO='Servicio';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nombre_servicio','estado','secuencia','paquete',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $servicio);

$aServicios = $servicio->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aServicios);

$smarty->assign("titulo", "Listado del Servicio");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>