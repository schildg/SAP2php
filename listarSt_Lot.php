<?php
include_once ("Clases/St_Lot.php");
$st_lot = new St_Lot();

$OBJETO='St_Lot';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_sl','marc_sl','enva_sl','cenv_sl',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $st_lot);

$aSt_Lots = $st_lot->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSt_Lots);

$smarty->assign("titulo", "Listado del St_Lot");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>