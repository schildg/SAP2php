<?php
include_once ("Clases/St_Art.php");
$st_art = new St_Art();

$OBJETO='St_Art';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_sa','marc_sa','enva_sa','cenv_sa',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $st_art);

$aSt_Arts = $st_art->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSt_Arts);

$smarty->assign("titulo", "Listado del St_Art");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>