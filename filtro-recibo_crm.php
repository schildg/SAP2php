<?php
include_once ("Clases/Recibo_CRM.php");
$smarty = new Smarty();
$recibo_crm = new Recibo_CRM();
$OBJETO = 'Recibo_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','BELNR','GJAHR','BLART','CRM_ID','FKDAT','DICOB','KUNNR','DIATR','KUNN2','UNNEG','DMBTR','DMBE2','SABTR','SABE2','WAERS',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del recibo_crm");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aRecibo_CRMs = $recibo_crm->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aRecibo_CRMs);

$smarty->display('ListadorDeDatos.tpl');
?>