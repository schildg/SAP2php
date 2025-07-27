<?php
include_once ("Clases/LineaMovimientoMaterial.php");
$smarty = new Smarty();
$lineamovimientomaterial = new LineaMovimientoMaterial();
$OBJETO = 'LineaMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','VEMNG','VEMEH','MATNR',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del lineamovimientomaterial");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aLineaMovimientoMaterials = $lineamovimientomaterial->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aLineaMovimientoMaterials);

$smarty->display('ListadorDeDatos.tpl');
?>