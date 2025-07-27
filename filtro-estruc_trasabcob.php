<?php
include_once ("Clases/Estruc_TrasabCob.php");
$smarty = new Smarty();
$estruc_trasabcob = new Estruc_TrasabCob();
$OBJETO = 'Estruc_TrasabCob';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ZNREC','ZFCON','ZFDOC','ZIMPO','ZNFAC','ZNLEG','ZFACT','ZFREC','ZFDRE','ZCHCK','ZFVFA','ZVCHE','ZTMOV','ZBANK','ZMCAN',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del estruc_trasabcob");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aEstruc_TrasabCobs = $estruc_trasabcob->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aEstruc_TrasabCobs);

$smarty->display('ListadorDeDatos.tpl');
?>