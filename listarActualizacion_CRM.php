<?php
include_once ("Clases/Actualizacion_CRM.php");
$actualizacion_crm = new Actualizacion_CRM();

$OBJETO='Actualizacion_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Objeto','Ultima_Actualizacion',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $actualizacion_crm);

$aActualizacion_CRMs = $actualizacion_crm->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aActualizacion_CRMs);

$smarty->assign("titulo", "Listado del Actualizacion_CRM");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>