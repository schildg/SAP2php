<?php
include_once ("Clases/Condicion_Pago.php");
$smarty = new Smarty();
$condicion_pago = new Condicion_Pago();
$OBJETO = 'Condicion_Pago';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ZTERM','ZTAGG','ZDART','ZFAEL','ZMONA','ZTAG1','ZPRZ1','ZTAG2','ZPRZ2','ZTAG3','ZSTG1','ZSMN1','ZSTG2','ZSMN2','ZSTG3','ZSMN3','XZBRV','ZSCHF','XCHPB','TXN08','ZLSCH','XCHPM','KOART','XSPLT','XSCRC','TEXT1');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del condicion_pago");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aCondicion_Pagos = $condicion_pago->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aCondicion_Pagos);

$smarty->display('ListadorDeDatos.tpl');
?>