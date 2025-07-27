<?php
include_once ("Clases/Out_OrdFab_Consumo.php");
$out_ordfab_consumo = new Out_OrdFab_Consumo();

$OBJETO='Out_OrdFab_Consumo';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','RSPOS','MATNR','WERKS',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $out_ordfab_consumo);

$aOut_OrdFab_Consumos = $out_ordfab_consumo->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aOut_OrdFab_Consumos);

$smarty->assign("titulo", "Listado del Out_OrdFab_Consumo");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>