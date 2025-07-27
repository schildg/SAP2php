<?php
include_once ("Clases/LoteMovimientoMaterial.php");
$smarty = new Smarty();
$lotemovimientomaterial = new LoteMovimientoMaterial();
$OBJETO = 'LoteMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','MATNR','CHARG','VEMNG','VEMEH','VFDAT',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del lotemovimientomaterial");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aLoteMovimientoMaterials = $lotemovimientomaterial->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aLoteMovimientoMaterials);

$smarty->display('ListadorDeDatos.tpl');
?>