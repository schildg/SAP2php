<?php
include_once ("Clases/Px_For.php");
$smarty = new Smarty();
$px_for = new Px_For();
$OBJETO = 'Px_For';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_lv','form_lv','cmov_lv','nmov_lv','nomb_lv','fech_lv','suma_lv','exci_lv','habi_lv','habi_lvt','cdor_lv','cost_lv','ubue_lv','tipo_lv','tipo_lvt','mezc_lv','mini_lv','pace_lv','maxi_lv','toke_lv','cadi_lv','cfor_lv','fcof_lv','line_lv','line_lvt','firm_lv','firm_lvt','fill_lv',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del px_for");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aPx_Fors = $px_for->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aPx_Fors);

$smarty->display('ListadorDeDatos.tpl');
?>