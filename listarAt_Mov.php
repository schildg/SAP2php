<?php
include_once ("Clases/At_Mov.php");
$at_mov = new At_Mov();

$OBJETO='At_Mov';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cmov_lu','nmov_lu','AUFNR','EXIDV_OB',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $at_mov);

$aAt_Movs = $at_mov->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aAt_Movs);

$smarty->assign("titulo", "Listado del At_Mov");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>