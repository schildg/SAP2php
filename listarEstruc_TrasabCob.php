<?php
include_once ("Clases/Estruc_TrasabCob.php");
$estruc_trasabcob = new Estruc_TrasabCob();

$OBJETO='Estruc_TrasabCob';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ZNREC','ZFCON','ZFDOC','ZIMPO',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $estruc_trasabcob);

$aEstruc_TrasabCobs = $estruc_trasabcob->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aEstruc_TrasabCobs);

$smarty->assign("titulo", "Listado del Estruc_TrasabCob");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>