<?php
include_once ("Clases/Accion.php");
$aCcion = new Accion();
$OBJETO='Accion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','comando','descripcion','fecha','habilitado','modulo','rotulo');

include_once ("datos-listador.php");

$smarty->assign("objeto", $aCcion);

$aAccions = $aCcion->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aAccions);

$aAccions = $aCcion->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("titulo", "Listado de Acciones");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>