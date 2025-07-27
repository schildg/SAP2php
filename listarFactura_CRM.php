<?php
include_once ("Clases/Factura_CRM.php");
$factura_crm = new Factura_CRM();

$OBJETO='Factura_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','VBELN','WAERK','VKORG','VTWEG',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $factura_crm);

$aFactura_CRMs = $factura_crm->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aFactura_CRMs);

$smarty->assign("titulo", "Listado del Factura_CRM");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>