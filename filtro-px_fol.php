<?php
include_once ("Clases/Px_Fol.php");
$smarty = new Smarty();
$px_fol = new Px_Fol();
$OBJETO = 'Px_Fol';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_ll','cmov_ll','nmov_ll','item_ll','site_ll','cant_ll','orde_ll','agma_ll','micr_ll','epex_ll','epec_ll','fill_ll',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del px_fol");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aPx_Fols = $px_fol->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aPx_Fols);

$smarty->display('ListadorDeDatos.tpl');
?>