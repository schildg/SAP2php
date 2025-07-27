<?php
include_once ("Clases/Out_GoodsMvment.php");
$smarty = new Smarty();
$out_goodsmvment = new Out_GoodsMvment();
$OBJETO = 'Out_GoodsMvment';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','MATNR','TEXT_MSEG_MATNR','WERKS','CHARG','LGORT','BWART','MJAHR','MBLNR','MENGE','MEINS','EXIDV','VENUM',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del out_goodsmvment");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aOut_GoodsMvments = $out_goodsmvment->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aOut_GoodsMvments);

$smarty->display('ListadorDeDatos.tpl');
?>