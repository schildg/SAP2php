<?php
include_once ("Clases/Ut_Hu.php");
$ut_hu = new Ut_Hu();

$OBJETO='Ut_Hu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cmov_lu','nmov_lu','AUFNR','EXIDV_OB',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $ut_hu);

$aUt_Hus = $ut_hu->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aUt_Hus);

$smarty->assign("titulo", "Listado del Ut_Hu");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>