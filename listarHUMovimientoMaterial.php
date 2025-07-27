<?php
include_once ("Clases/HUMovimientoMaterial.php");
$humovimientomaterial = new HUMovimientoMaterial();

$OBJETO='HUMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','MATNR','CHARG',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $humovimientomaterial);

$aHUMovimientoMaterials = $humovimientomaterial->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aHUMovimientoMaterials);

$smarty->assign("titulo", "Listado del HUMovimientoMaterial");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>