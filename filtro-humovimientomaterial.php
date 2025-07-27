<?php
include_once ("Clases/HUMovimientoMaterial.php");
$smarty = new Smarty();
$humovimientomaterial = new HUMovimientoMaterial();
$OBJETO = 'HUMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','MATNR','CHARG','EXIDV','VEMNG','VEMEH',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del humovimientomaterial");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aHUMovimientoMaterials = $humovimientomaterial->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aHUMovimientoMaterials);

$smarty->display('ListadorDeDatos.tpl');
?>