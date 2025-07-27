<?php
include_once ("Clases/Venta_CRM_TMP.php");
$smarty = new Smarty();
$venta_crm_tmp = new Venta_CRM_TMP();
$OBJETO = 'Venta_CRM_TMP';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','KUNNR','MATNR','KUNN2','VKORG','UNNEG','WAERK','ZTERM','BSARK','AUART','WERKS','LGORT','PRCTR','VKGRP','VKBUR','XBLNR','VBELN','POSNR','ERDAT','PU_ML','PU_USD','NETPR','NETPR_USD','CU_ML','CU_USD','WAVWR','WAVWR_USD','ZMENG','ZIEME','STCUR','BSTNK','MEINS','VRKME','HB_EXPDATE','BUKRS','FKART','KKBER','DOCFI','GJAHR','BLART','SHKZG','ZFBDT','PERIO',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del venta_crm_tmp");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aVenta_CRM_TMPs = $venta_crm_tmp->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aVenta_CRM_TMPs);

$smarty->display('ListadorDeDatos.tpl');
?>