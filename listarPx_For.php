<?php
include_once ("Clases/Px_For.php");
$px_for = new Px_For();

$OBJETO='Px_For';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_lv','form_lv','cmov_lv','nmov_lv',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $px_for);

$aPx_Fors = $px_for->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aPx_Fors);

$smarty->assign("titulo", "Listado del Px_For");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>