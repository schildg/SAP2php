<?php
include_once ("Clases/St_Mar.php");
$smarty = new Smarty();
$st_mar = new St_Mar();
$OBJETO = 'St_Mar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_sm','marc_sm','deco_sm','habi_sm','impo_sm');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del st_mar");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aSt_Mars = $st_mar->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aSt_Mars);

$smarty->display('ListadorDeDatos.tpl');
?>