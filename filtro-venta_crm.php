<?php
include_once ("Clases/Venta_CRM.php");
$smarty = new Smarty();
$venta_crm = new Venta_CRM();
$OBJETO = 'Venta_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','KUNNR','MATNR','KUNN2','VKORG','WAERK','ZTERM','BSARK','AUART','WERKS','LGORT','PRCTR','VKGRP','VKBUR','XBLNR','VBELN','ERDAT','PU_ML','PU_USD','NETPR','NETPR_USD','CU_ML','CU_USD','WAVWR','WAVWR_USD','ZMENG','ZIEME','STCUR','BSTNK','MEINS','VRKME',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del venta_crm");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aVenta_CRMs = $venta_crm->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aVenta_CRMs);

$smarty->display('ListadorDeDatos.tpl');
?>