<?php
include_once ("Clases/Establecimiento.php");
$establecimiento = new Establecimiento();

$OBJETO='Establecimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nombre','direccion','nivel','tipo','logo_1','logo_2','localidad_id');

include_once ("datos-listador.php");

$smarty->assign("objeto", $establecimiento);

$aEstablecimientos = $establecimiento->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aEstablecimientos);

$smarty->assign("titulo", "Listado del Establecimiento");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>