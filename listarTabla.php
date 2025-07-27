<?php
include_once ("Clases/Tabla.php");
$tabla = new Tabla();

$OBJETO='Tabla';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','campo','numero','habilitado','nombre','noco','objeto');

include_once ("datos-listador.php");

$smarty->assign("objeto", $tabla);

$aTablas = $tabla->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aTablas);

$smarty->assign("titulo", "Listado de los valores de las Tablas");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>