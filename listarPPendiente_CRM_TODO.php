<?php
include_once ("Clases/PPendiente_CRM_TODO.php");
$ppendiente_crm_todo = new PPendiente_CRM_TODO();

$OBJETO='PPendiente_CRM_TODO';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','CRM_ID','AUART','VBELN',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $ppendiente_crm_todo);

$aPPendiente_CRM_TODOs = $ppendiente_crm_todo->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aPPendiente_CRM_TODOs);

$smarty->assign("titulo", "Listado del PPendiente_CRM_TODO");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>