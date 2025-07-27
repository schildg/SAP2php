<?php
include_once ("Clases/Sl_Utr.php");
$smarty = new Smarty();
$sl_utr = new Sl_Utr();
$OBJETO = 'Sl_Utr';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','diac_lu','esta_lu','esta_lut','lotc_lu','lotn_lu','cmov_lu','nmov_lu','tipo_lu','cant_lu','sald_lu','rese_lu','cdoc_lu','ndoc_lu','frec_lu','esfi_lu','erec_lu','erec_lut','ulti_lu','isol_lu','esti_lu','esti_lut','care_lu','fill_lu',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del sl_utr");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aSl_Utrs = $sl_utr->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aSl_Utrs);

$smarty->display('ListadorDeDatos.tpl');
?>