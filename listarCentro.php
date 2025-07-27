<?php
include_once ("Clases/Centro.php");
$centro = new Centro();

$OBJETO='Centro';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','WERKS','NAME1','BWKEY','KUNNR',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $centro);

$aCentros = $centro->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aCentros);

$smarty->assign("titulo", "Listado del Centro");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>