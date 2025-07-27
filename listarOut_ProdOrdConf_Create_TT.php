<?php
include_once ("Clases/Out_ProdOrdConf_Create_TT.php");
$out_prodordconf_create_tt = new Out_ProdOrdConf_Create_TT();

$OBJETO='Out_ProdOrdConf_Create_TT';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CONF_NO','ORDERID','SEQUENCE','OPERATION',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $out_prodordconf_create_tt);

$aOut_ProdOrdConf_Create_TTs = $out_prodordconf_create_tt->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aOut_ProdOrdConf_Create_TTs);

$smarty->assign("titulo", "Listado del Out_ProdOrdConf_Create_TT");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>