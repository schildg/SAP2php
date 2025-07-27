<?php
include_once ("Clases/St_Rld.php");
$smarty = new Smarty();
$st_rld = new St_Rld();
$OBJETO = 'St_Rld';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cmov_sr','nmov_sr','item_sr','pro1_sr','lotc_sr','lotn_sr','prod_sr','marc_sr','enva_sr','cenv_sr','sign_sr','cant_sr','depo_sr','dep1_sr','moti_sr','itom_sr','fill_sr',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del st_rld");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aSt_Rlds = $st_rld->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aSt_Rlds);

$smarty->display('ListadorDeDatos.tpl');
?>