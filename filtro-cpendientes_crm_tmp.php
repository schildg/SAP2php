<?php
include_once ("Clases/CPendientes_CRM_TMP.php");
$smarty = new Smarty();
$cpendientes_crm_tmp = new CPendientes_CRM_TMP();
$OBJETO = 'CPendientes_CRM_TMP';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','EBELN','EBELP','EKORG','EKGRP','BSART','AEDAT','EEIND','LIFNR','MATNR','WERKS','LGORT','MENGE','MEINS','WAERS','WKURS','CU_PESO','CU_DOLAR','COSTO_PESO','COSTO_DOLAR','COSTO_NAC_PESO','COSTO_NAC_DOLAR','ESTADO',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del cpendientes_crm_tmp");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aCPendientes_CRM_TMPs = $cpendientes_crm_tmp->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aCPendientes_CRM_TMPs);

$smarty->display('ListadorDeDatos.tpl');
?>