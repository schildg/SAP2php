<?php
include_once ("Clases/St_Mar.php");
$st_mar = new St_Mar();

$OBJETO='St_Mar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_sm','marc_sm','deco_sm','habi_sm',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $st_mar);

$aSt_Mars = $st_mar->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSt_Mars);

$smarty->assign("titulo", "Listado del St_Mar");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>