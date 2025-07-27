<?php
include_once ("Clases/Stock_CRM.php");
$stock_crm = new Stock_CRM();

$OBJETO='Stock_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','WERKS','LGORT','LABST',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $stock_crm);

$aStock_CRMs = $stock_crm->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aStock_CRMs);

$smarty->assign("titulo", "Listado del Stock_CRM");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>