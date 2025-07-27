<?php
include_once ("Clases/Stock_CRM.php");
$smarty = new Smarty();
$stock_crm = new Stock_CRM();
$OBJETO = 'Stock_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','WERKS','LGORT','LABST','INSME','RESERV','RESERVENTRE','CURSO','CU','CU_USD','TRANSITO',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del stock_crm");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aStock_CRMs = $stock_crm->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aStock_CRMs);

$smarty->display('ListadorDeDatos.tpl');
?>