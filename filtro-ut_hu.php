<?php
include_once ("Clases/Ut_Hu.php");
$smarty = new Smarty();
$ut_hu = new Ut_Hu();
$OBJETO = 'Ut_Hu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cmov_lu','nmov_lu','AUFNR','EXIDV_OB','estado',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del ut_hu");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aUt_Hus = $ut_hu->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aUt_Hus);

$smarty->display('ListadorDeDatos.tpl');
?>