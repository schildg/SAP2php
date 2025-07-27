<?php
include_once ("Clases/Cliente_CRM.php");
$cliente_crm = new Cliente_CRM();

$OBJETO='Cliente_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','KUNNR','VKORG','VTWEG',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $cliente_crm);

$aCliente_CRMs = $cliente_crm->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aCliente_CRMs);

$smarty->assign("titulo", "Listado del Cliente_CRM");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>