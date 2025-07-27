<?php
include_once ("Clases/Venta_Anita.php");
$smarty = new Smarty();
$venta_anita = new Venta_Anita();
$OBJETO = 'Venta_Anita';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','KUNNR','MATNR','KUNN2','VKORG','UNNEG','WAERK','ZTERM','BSARK','AUART','WERKS','LGORT','PRCTR','VKGRP','VKBUR','XBLNR','VBELN','POSNR','ERDAT','PU_ML','PU_USD','NETPR','NETPR_USD','CU_ML','CU_USD','WAVWR','WAVWR_USD','ZMENG','ZIEME','STCUR','BSTNK','MEINS','VRKME','HB_EXPDATE','BUKRS','FKART','KKBER','DOCFI','GJAHR','BLART','SHKZG','ZFBDT','PERIO',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del venta_anita");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aVenta_Anitas = $venta_anita->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aVenta_Anitas);

$smarty->display('ListadorDeDatos.tpl');
?>