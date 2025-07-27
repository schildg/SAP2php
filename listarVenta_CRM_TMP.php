<?php
include_once ("Clases/Venta_CRM_TMP.php");
$venta_crm_tmp = new Venta_CRM_TMP();

$OBJETO='Venta_CRM_TMP';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','KUNNR','MATNR','KUNN2',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $venta_crm_tmp);

$aVenta_CRM_TMPs = $venta_crm_tmp->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aVenta_CRM_TMPs);

$smarty->assign("titulo", "Listado del Venta_CRM_TMP");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>