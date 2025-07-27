<?php
include_once ("Clases/Actualizacion_CRM.php");
$smarty = new Smarty();
$actualizacion_crm = new Actualizacion_CRM();
$OBJETO = 'Actualizacion_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Objeto','Ultima_Actualizacion',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del actualizacion_crm");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aActualizacion_CRMs = $actualizacion_crm->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aActualizacion_CRMs);

$smarty->display('ListadorDeDatos.tpl');
?>