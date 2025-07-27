<?php
include_once ("Clases/Sl_Utr.php");
$sl_utr = new Sl_Utr();

$OBJETO='Sl_Utr';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','diac_lu','esta_lu','esta_lut','lotc_lu',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $sl_utr);

$aSl_Utrs = $sl_utr->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSl_Utrs);

$smarty->assign("titulo", "Listado del Sl_Utr");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>