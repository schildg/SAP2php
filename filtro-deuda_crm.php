<?php
include_once ("Clases/Deuda_CRM.php");
$smarty = new Smarty();
$deuda_crm = new Deuda_CRM();
$OBJETO = 'Deuda_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','FECHA','CODIGO_PAIS','BLART','VBELN','BUKRS','BELNR','GJAHR','XBLNR','WAERK','VKORG','VTWEG','FKDAT','KURRF','ZTERM','KUNNR','KUNN2','DMBTR','DMBE2','SABTR','SABE2','KKBER','ZFBDT','SHKZG',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del deuda_crm");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aDeuda_CRMs = $deuda_crm->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aDeuda_CRMs);

$smarty->display('ListadorDeDatos.tpl');
?>