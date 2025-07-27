<?php
include_once ("Clases/Componente.php");
$smarty = new Smarty();
$componente = new Componente();
$OBJETO = 'Componente';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','RESERVATION_NUMBER','RESERVATION_ITEM','RESERVATION_TYPE','DELETION_INDICATOR','MATERIAL','PROD_PLANT','STORAGE_LOCATION','SUPPLY_AREA','BATCH','SPECIAL_STOCK','REQ_DATE','REQ_QUAN','BASE_UOM','BASE_UOM_ISO','WITHDRAWN_QUANTITY','ENTRY_QUANTITY','ENTRY_UOM','ENTRY_UOM_ISO','ORDER_NUMBER','MOVEMENT_TYPE','ITEM_CATEGORY','ITEM_NUMBER','SEQUENCE','OPERATION','BACKFLUSH','VALUATION_SPEC_STOCK','SYSTEM_STATUS','MATERIAL_DESCRIPTION','COMMITED_QUANTITY','SHORTAGE','PURCHASE_REQ_NO','PURCHASE_REQ_ITEM','MATERIAL_EXTERNAL','MATERIAL_GUID','MATERIAL_VERSION',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del componente");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aComponentes = $componente->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aComponentes);

$smarty->display('ListadorDeDatos.tpl');
?>