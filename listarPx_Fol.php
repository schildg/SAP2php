<?php
include_once ("Clases/Px_Fol.php");
$px_fol = new Px_Fol();

$OBJETO='Px_Fol';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_ll','cmov_ll','nmov_ll','item_ll',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $px_fol);

$aPx_Fols = $px_fol->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aPx_Fols);

$smarty->assign("titulo", "Listado del Px_Fol");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>