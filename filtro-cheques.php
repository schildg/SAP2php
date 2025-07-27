<?php
include_once ("Clases/Cheques.php");
$smarty = new Smarty();
$cheques = new Cheques();
$OBJETO = 'Cheques';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','NCHCK','BLDAT','BELNR','GJAHR','BUZEI','FEEMI','FEVEN','TPCHK','INDDF','BANK','SUCU','POST','LOCA','CHCKR','WAERS','WRBTR','CTAB','CART','CLAU','EMIS','KUNNR','SEGMT','LOTE','ESTAD','SEL',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del cheques");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aChequess = $cheques->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aChequess);

$smarty->display('ListadorDeDatos.tpl');
?>