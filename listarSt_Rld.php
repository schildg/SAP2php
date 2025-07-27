<?php
include_once ("Clases/St_Rld.php");
$st_rld = new St_Rld();

$OBJETO='St_Rld';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cmov_sr','nmov_sr','item_sr','pro1_sr',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $st_rld);

$aSt_Rlds = $st_rld->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSt_Rlds);

$smarty->assign("titulo", "Listado del St_Rld");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>