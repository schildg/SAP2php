<?php
include_once ("Clases/CabeceraMovimientoMaterial.php");
$cabeceramovimientomaterial = new CabeceraMovimientoMaterial();

$OBJETO='CabeceraMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','TR_EV_TYPE','PSTNG_DATE',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $cabeceramovimientomaterial);

$aCabeceraMovimientoMaterials = $cabeceramovimientomaterial->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aCabeceraMovimientoMaterials);

$smarty->assign("titulo", "Listado del CabeceraMovimientoMaterial");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>