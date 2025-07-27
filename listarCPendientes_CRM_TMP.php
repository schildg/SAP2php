<?php
include_once ("Clases/CPendientes_CRM_TMP.php");
$cpendientes_crm_tmp = new CPendientes_CRM_TMP();

$OBJETO='CPendientes_CRM_TMP';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','EBELN','EBELP','EKORG',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $cpendientes_crm_tmp);

$aCPendientes_CRM_TMPs = $cpendientes_crm_tmp->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aCPendientes_CRM_TMPs);

$smarty->assign("titulo", "Listado del CPendientes_CRM_TMP");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>