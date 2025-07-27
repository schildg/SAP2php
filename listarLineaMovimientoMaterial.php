<?php
include_once ("Clases/LineaMovimientoMaterial.php");
$lineamovimientomaterial = new LineaMovimientoMaterial();

$OBJETO='LineaMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','VEMNG','VEMEH',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $lineamovimientomaterial);

$aLineaMovimientoMaterials = $lineamovimientomaterial->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aLineaMovimientoMaterials);

$smarty->assign("titulo", "Listado del LineaMovimientoMaterial");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>