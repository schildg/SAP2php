<?php
include_once ("Clases/Accion.php");
$smarty = new Smarty();
$aCcion = new Accion();
$OBJETO = 'Accion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','comando','descripcion','fecha','habilitado','modulo','rotulo');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de las Acciones");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aAccions = $aCcion->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aAccions);

$smarty->display('ListadorDeDatos.tpl');
?>