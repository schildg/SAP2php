<?php
include_once ("Clases/St_Lar.php");
$st_lar = new St_Lar();

$OBJETO='St_Lar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_gd','marc_gd','enva_gd','cenv_gd',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $st_lar);

$aSt_Lars = $st_lar->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSt_Lars);

$smarty->assign("titulo", "Listado del St_Lar");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>