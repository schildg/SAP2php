<?php
include_once ("Clases/LoteMovimientoMaterial.php");
$lotemovimientomaterial = new LoteMovimientoMaterial();

$OBJETO='LoteMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','MATNR','CHARG',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $lotemovimientomaterial);

$aLoteMovimientoMaterials = $lotemovimientomaterial->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aLoteMovimientoMaterials);

$smarty->assign("titulo", "Listado del LoteMovimientoMaterial");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>