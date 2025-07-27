<?php
include_once ("Clases/Recibo_CRM.php");
$recibo_crm = new Recibo_CRM();

$OBJETO='Recibo_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','BELNR','GJAHR','BLART',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $recibo_crm);

$aRecibo_CRMs = $recibo_crm->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aRecibo_CRMs);

$smarty->assign("titulo", "Listado del Recibo_CRM");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>