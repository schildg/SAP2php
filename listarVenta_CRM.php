<?php
include_once ("Clases/Venta_CRM.php");
$venta_crm = new Venta_CRM();

$OBJETO='Venta_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','KUNNR','MATNR','KUNN2','VKORG',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $venta_crm);

$aVenta_CRMs = $venta_crm->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aVenta_CRMs);

$smarty->assign("titulo", "Listado del Venta_CRM");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>