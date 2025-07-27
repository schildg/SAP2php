<?php
include_once ("Clases/Out_GoodsMvment.php");
$out_goodsmvment = new Out_GoodsMvment();

$OBJETO='Out_GoodsMvment';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','MATNR','TEXT_MSEG_MATNR','WERKS',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $out_goodsmvment);

$aOut_GoodsMvments = $out_goodsmvment->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aOut_GoodsMvments);

$smarty->assign("titulo", "Listado del Out_GoodsMvment");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>