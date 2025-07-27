<?php
include_once ("Clases/CabeceraMovimientoMaterial.php");
$smarty = new Smarty();
$cabeceramovimientomaterial = new CabeceraMovimientoMaterial();
$OBJETO = 'CabeceraMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','TR_EV_TYPE','PSTNG_DATE','REF_DOC_NO','VBELN','WERKS','LGORT','WDATU',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del cabeceramovimientomaterial");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aCabeceraMovimientoMaterials = $cabeceramovimientomaterial->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aCabeceraMovimientoMaterials);

$smarty->display('ListadorDeDatos.tpl');
?>