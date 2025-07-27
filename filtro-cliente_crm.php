<?php
include_once ("Clases/Cliente_CRM.php");
$smarty = new Smarty();
$cliente_crm = new Cliente_CRM();
$OBJETO = 'Cliente_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','KUNNR','VKORG','VTWEG','SPART','NAME1','STCD1','STRAS','ORT02','PSTLZ','REGIO','LAND1','FITYP','ZTERM','KKBER','KLIMK','KUNN2','OWNER',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del cliente_crm");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aCliente_CRMs = $cliente_crm->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aCliente_CRMs);

$smarty->display('ListadorDeDatos.tpl');
?>