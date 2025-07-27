<?php
include_once ("Clases/Posicion.php");
$smarty = new Smarty();
$posicion = new Posicion();
$OBJETO = 'Posicion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ORDER_NUMBER','ORDER_ITEM_NUMBER','SALES_ORDER','SALES_ORDER_ITEM','SCRAP','QUANTITY','DELIVERED_QUANTITY','BASE_UNIT','BASE_UNIT_ISO','MATERIAL','ACTUAL_DELIVERY_DATE','PLANNED_DELIVERY_DATE','PLAN_PLANT','STORAGE_LOCATION','DELIVERY_COMPL','PRODUCTION_VERSION','PROD_PLANT','ORDER_TYPE','FINISH_DATE','PRODUCTION_FINISH_DATE','BATCH','DELETION_FLAG','MRP_AREA','MATERIAL_TEXT','MATERIAL_EXTERNAL','MATERIAL_GUID','MATERIAL_VERSION',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del posicion");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aPosicions = $posicion->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aPosicions);

$smarty->display('ListadorDeDatos.tpl');
?>