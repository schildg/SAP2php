<?php
include_once ("Clases/Material.php");
$material = new Material();

$OBJETO='Material';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','ERSDA','ERNAM','LAEDA',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $material);

$aMaterials = $material->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aMaterials);

$smarty->assign("titulo", "Listado del Material");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>