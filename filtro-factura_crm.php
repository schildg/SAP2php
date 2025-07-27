<?php
include_once ("Clases/Factura_CRM.php");
$smarty = new Smarty();
$factura_crm = new Factura_CRM();
$OBJETO = 'Factura_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','VBELN','WAERK','VKORG','VTWEG','FKDAT','KURRF','ZTERM','CRM_ID','FKVEN','FKREC','KUNNR','DIATR','KUNN2',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del factura_crm");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aFactura_CRMs = $factura_crm->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aFactura_CRMs);

$smarty->display('ListadorDeDatos.tpl');
?>