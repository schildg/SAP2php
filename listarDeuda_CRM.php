<?php
include_once ("Clases/Deuda_CRM.php");
$deuda_crm = new Deuda_CRM();

$OBJETO='Deuda_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','FECHA','CODIGO_PAIS','BLART','VBELN',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $deuda_crm);

$aDeuda_CRMs = $deuda_crm->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aDeuda_CRMs);

$smarty->assign("titulo", "Listado del Deuda_CRM");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>