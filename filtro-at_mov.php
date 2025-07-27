<?php
include_once ("Clases/At_Mov.php");
$smarty = new Smarty();
$at_mov = new At_Mov();
$OBJETO = 'At_Mov';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cmov_lu','nmov_lu','AUFNR','EXIDV_OB','estado','MBLNR','MJAH',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del at_mov");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aAt_Movs = $at_mov->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aAt_Movs);

$smarty->display('ListadorDeDatos.tpl');
?>