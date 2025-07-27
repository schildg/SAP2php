<?php
include_once ("Clases/Existencia_Material.php");
$existencia_material = new Existencia_Material();

$OBJETO='Existencia_Material';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','WERKS','LGORT','PSTAT',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $existencia_material);

$aExistencia_Materials = $existencia_material->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aExistencia_Materials);

$smarty->assign("titulo", "Listado del Existencia_Material");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>