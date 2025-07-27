<?php
include_once ("Clases/Cheques_CRM_TODO.php");
$cheques_crm_todo = new Cheques_CRM_TODO();

$OBJETO='Cheques_CRM_TODO';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','BUKRS','NCHCK','BLDAT',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $cheques_crm_todo);

$aCheques_CRM_TODOs = $cheques_crm_todo->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aCheques_CRM_TODOs);

$smarty->assign("titulo", "Listado del Cheques_CRM_TODO");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>