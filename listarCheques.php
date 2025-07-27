<?php
include_once ("Clases/Cheques.php");
$cheques = new Cheques();

$OBJETO='Cheques';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','NCHCK','BLDAT','BELNR',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $cheques);

$aChequess = $cheques->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aChequess);

$smarty->assign("titulo", "Listado del Cheques");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>