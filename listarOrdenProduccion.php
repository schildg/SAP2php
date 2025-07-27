<?php
include_once ("Clases/OrdenProduccion.php");
$ordenproduccion = new OrdenProduccion();

$OBJETO='OrdenProduccion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ORDER_NUMBER','PRODUCTION_PLANT','MRP_CONTROLLER','PRODUCTION_SCHEDULER',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $ordenproduccion);

$aOrdenProduccions = $ordenproduccion->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aOrdenProduccions);

$smarty->assign("titulo", "Listado del OrdenProduccion");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>